<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:model {name} {--cols=} {--filter=} {--fRelation=} {--xlx=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate Admin Model';

    protected $colsMigration = [];
    protected $colsValidations = [];
    protected $colsFiltration = [];
    protected $RelationFunctions = [];
    protected $functionNames ='';

    /**
     * Create a new command instance.
     *
     * @return void
     */

//    public function __construct()
//    {
//        parent::__construct();
//    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ClassName = $this->argument('name');
        if($this->option('cols')){
            $this->setCols();
            $this->setColsValidation();
        }
        if($this->option('filter')){
            $this->setColsFilter();
        }
        if($this->option('fRelation')){
            $this->setfRelation();
        }

        $this->createModel($ClassName);
        $this->line('Done create  Model'.$this->reFormatValidationFunctionRelation());
    }

    protected function setCols(){
        $cols = $this->option('cols');
        $cols = explode(',' , $cols);

        foreach($cols as $col){
            $col = explode(':' , $col);
            foreach($col as $key => $c){
                if($key == 0){
                    $name = $c;
                }elseif($key == 1){
                    $this->colsMigration[$name] = $c;
                }
            }
        }
    }

    protected function setfRelation(){
        $cols = $this->option('fRelation');

        $cols = explode(',' , $cols);
        foreach($cols as $col){
            $col = explode(':' , $col);
            foreach($col as $key => $c){
                if($key == 0){
                    $name = $c;
                }elseif($key == 1){
                    $this->RelationFunctions[$name]['relation'] = $c;
                }else{
                    $this->RelationFunctions[$name]['model'] = $c;
                }
            }
        }
    }

    protected function setColsFilter(){
        $cols = $this->option('filter');
        $cols = explode(',' , $cols);
        $this->colsFiltration = $cols;
    }

    public function setColsValidation()
    {
        $cols = $this->option('cols');
        $cols = explode(',' , $cols);
        foreach($cols as $col){

            $col = explode(':' , $col);
            foreach($col as $key => $c){
                $count = count($col);
                if($count == 2){
                    if($key == 0){
                        $name = $c;
                    }elseif($key == 1){
                        $this->colsValidations[$name][] = 'nullable';
                    }
                }else{
                    if($key == 0){
                        $name = $c;
                    }elseif($key == 2){
                        $this->colsValidations[$name][] = $c;
                    }elseif ($key > 2){
                        $this->colsValidations[$name][] = $c;
                    }
                }

            }
        }

    }

    protected function reFormatValidationRequest(){
        $array = [
            'string',
            'boolean',
            'char',
            'date',
            'double',
            'text',
            'mediumText',
            'longText',
            'float',
            'integer',
            'ipAddress',
            'tinyInteger'
        ];

        $reuslt = '';
        $i = 0;
        $count = count($this->colsValidations);
        foreach($this->colsValidations as $key => $value){

            $i++;
            $reuslt .= "'".$key."' => ";
            if(count($value) == 1){
                $reuslt .= "'".$value[0]."'";
            }else{
                $iv = 0;
                $reuslt .= "'";
                foreach ($value as $val){
                    $iv++;
                    $reuslt .= $val;
                    if($iv != count($value)){
                        $reuslt .= '|';
                    }
                }
                $reuslt .= "'";
            }
            if($count != $i){
                $reuslt .=',';
            }
            $reuslt .= "\n\t\t\t";

        }
        return $reuslt;
    }
    protected function reFormatValidationFunctionRelation(){

        $reuslt = '';
        $this->functionNames = "'";
        $count = count($this->RelationFunctions);
        if(count($count) > 0){
            $i=0;
            $url = "\App\Modules";

            foreach($this->RelationFunctions as $key => $value){
                $i++;
                $this->functionNames .= $key;
                if($i != count($count)){
                    $this->functionNames .= ',';
                }
                $reuslt .= " public function ".$key."(){";
                $reuslt .= "\n\t\t\t";
                $reuslt .= "return "."$"."this->".$value['relation']."(".$url;
                $reuslt .= '\\'.$value['model']."\Models\\".$value['model']."::class);";
                $reuslt .= "\n\t\t\t";
                $reuslt .= "}";
                $reuslt .= "\n\t\t\t";

            }
        }
        $this->functionNames .= "'";
        return $reuslt;
    }

    protected function createModel($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Models/'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Models/'), 0777, true);
        }
        $path = app_path('Modules/' . $ClassName . '/Models/' . $ClassName . '.php');
        $this->line('Done create Model ' . $ClassName);
        $this->files->put($path, $this->buildClass($ClassName));
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $datafiled = $this->filleddata();
        $FilterData = $this->FilterData();
        $validation = $this->reFormatValidationRequest();
        $functions =  $this->reFormatValidationFunctionRelation();
        $xlxstatus = 'false';
        if($this->option('xlx')){
            $xlxstatus = 'true';
        }


        $this->replace( $stub, 'FilledsData',$datafiled);
        $this->replace( $stub, 'FilterDataCols',$FilterData);
        $this->replace( $stub, 'validationData',$validation);
        $this->replace( $stub, 'NFunc',$this->functionNames);
        $this->replace( $stub, 'xlxstatus',$xlxstatus);


        $this->replace( $stub, 'functions',$functions);
        $this->replace( $stub, 'DummyModel',lcfirst($this->getPluralPrase($name)));
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

    }

    public static function getPluralPrase($phrase){
        $plural='';
        for($i=0;$i<strlen($phrase);$i++){
            if($i==strlen($phrase)-1){
                $plural.=($phrase[$i]=='y')? 'ies':(($phrase[$i]=='s'|| $phrase[$i]=='x' || $phrase[$i]=='z' || $phrase[$i]=='ch' || $phrase[$i]=='sh')? $phrase[$i].'es' :$phrase[$i].'s');
            }else{
                $plural.=$phrase[$i];
            }
        }
        return $plural;
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    protected function replace(&$stub, $rep, $name)
    {
        $stub = str_replace(
            [$rep],
            $name,
            $stub
        );

        return $this;
    }

    protected function buildView($name, $stub)
    {
        $stub = $this->files->get($stub);

        return $this->replaceView($stub, 'DummyView', $name);
    }

    protected function replaceView(&$stub, $rep, $name)
    {


        $stub = str_replace(
            $rep,
            $name,
            $stub
        );
        return $stub;
    }

    protected function filleddata(){
        $reuslt = '';
        $count = count($this->colsMigration);
        $i= 0;
        foreach($this->colsMigration as $key => $value){
            $i++;
            $reuslt .= "'".$key."'";
            if($count != $i){
                $reuslt .= ',';
            }


        }
        return $reuslt;
    }

    protected function FilterData(){
        $reuslt = '';
        $count = count($this->colsFiltration);
        $i= 0;
        foreach($this->colsFiltration as $value){
            $i++;
            $reuslt .= "'".$value."'";
            if($count != $i){
                $reuslt .= ',';
            }


        }
        return $reuslt;
    }
}
