<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;

class GenerateDatabase extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:database {name} {--cols=} {--relation=} {--many=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate database';
    protected $colsMigration = [];
    protected $colsMigrationRelation = [];
    protected $colsMigrationManyRelation = [];

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
        }

        if($this->option('relation')){
            $this->setColsRelation();
        }

        if($this->option('many')){
            $this->setColsManyRelation();
            $this->createDatabaseMany($ClassName);
        }


        $this->createDatabase($ClassName);

        $this->line('Done create Database');
    }

    protected function createDatabase($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Database/factories'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Database/factories'), 0777, true);
        }
        if (!file_exists(app_path('Modules/' . $ClassName . '/Database/Migrations'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Database/Migrations'), 0777, true);
        }
        if (!file_exists(app_path('Modules/' . $ClassName . '/Database/seeds'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Database/seeds'), 0777, true);
        }
        $controllerName = $ClassName . 'Controller';
        $repo = $ClassName . 'Repo';
        $transformer = $ClassName . 'Resource';
        $modelName = $ClassName;
        $viewName = $ClassName;
        $Factory = app_path('Modules/' . $ClassName . '/Database/factories/' . $ClassName . 'Factory.php');
        $Migration = app_path('Modules/' . $ClassName . '/Database/Migrations/' . date("Y_m_d") .'_'.time(). '_create_' . $ClassName . '_table.php');
        $Seeder = app_path('Modules/' . $ClassName . '/Database/seeds/DatabaseSeeder.php');
        $this->line('Done create database ' . $ClassName);
        $this->files->put($Factory, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/factory.stub'));
        $this->files->put($Migration, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/migration.stub'));
        $this->files->put($Seeder, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/seeder.stub'));
    }

    protected function createDatabaseMany($ClassName){

        if (!file_exists(app_path('Modules/' . $ClassName . '/Database/Migrations'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Database/Migrations'), 0777, true);
        }

        $controllerName = $ClassName . 'Controller';

        $modelName = $ClassName;
        $TableClassName = $this->buildDataRelation('name');

        $Migration = app_path('Modules/' . $ClassName . '/Database/Migrations/' . date("Y_m_d") .'_'.time(). '_create_' . $TableClassName . '_table.php');

        $this->files->put($Migration, $this->buildClassControllerMany($ClassName, $controllerName, $modelName, __DIR__ . '/stubs/migrationMany.stub'));
    }

    protected function buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, $stub)
    {
        $stub = $this->files->get($stub);

        return $this->replace($stub, 'DummyModel', lcfirst($this->getPluralPrase($modelName)))
            ->replace($stub , 'DummyFields', $this->reFormatRequest())
            ->replace($stub , 'constraint', $this->formatConstraint())
            ->replace($stub , 'ModelClassName', $modelName)
            ->replace($stub, 'DummyView', $viewName)
            ->replace($stub, 'DummyRepo', $repo)
            ->replace($stub, 'DummyTransformer', $transformer)
            ->replaceNamespace($stub, $ClassName)
            ->replaceClass($stub, $controllerName);
    }
    protected function buildClassControllerMany($ClassName, $controllerName, $modelName, $stub)
    {
        $stub = $this->files->get($stub);

        return $this->replace($stub, 'DummyModel', $this->buildDataRelation('tname'))
            ->replace($stub , 'DummyFields', $this->buildDataRelation('col'))
            ->replace($stub , 'ModelClassName', $this->buildDataRelation('name'))
            ->replaceNamespace($stub, $ClassName)
            ->replaceClass($stub, $controllerName);
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
            [$rep],
            $name,
            $stub
        );
        return $stub;
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

    protected function setColsRelation(){
        $cols = $this->option('relation');
        $cols = explode(',' , $cols);
        foreach($cols as $col){
            $col = explode(':' , $col);
            foreach($col as $key => $c){
                if($key == 0){
                    $name = $c;
                }elseif($key == 1){
                    $this->colsMigrationRelation[$name] = $c;
                }
            }
        }
    }

    protected function setColsManyRelation(){
        $cols = $this->option('many');
        $cols = explode(',' , $cols);
        foreach($cols as $col){
            $col = explode(':' , $col);
            foreach($col as $key => $c){
                if($key == 0){
                    $name = $c;
                }elseif($key == 1){
                    $this->colsMigrationManyRelation[$name] = $c;
                }
            }
        }
    }

    protected function reFormatRequest(){
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
        foreach($this->colsMigration as $key => $value){
            $nullable = in_array($value  , $array) ? "->nullable()" : '';
            if(str_contains( $key , '[]')){
                $key = str_replace('[]' ,'', $key);
                $value = 'text';
            }
            $reuslt .= '$table->'.$value.'("'.$key.'")'.$nullable.';'."\n\t\t\t";
        }

        return $reuslt;
    }
    protected function buildDataRelation($type){
        $reuslt = '';
        $i = 0;
        foreach($this->colsMigrationManyRelation as $key => $value){
            if($type == 'name'){
                $reuslt .= $key;
            }elseif ($type == 'tname'){
                $reuslt .=  lcfirst($key);
                if($i == 0){
                    $reuslt .= '_';
                    $i++;
                }
            }
            else{
                $reuslt .= '$table->unsignedInteger("'.$value.'");';
                $reuslt .="\n\t\t\t";
                $reuslt .= '$table->foreign("'.$value.'") ->references("id")->on("'.lcfirst($this->getPluralPrase($key)).'")
              ->onDelete("cascade");';
                $reuslt .= "\n\t\t\t";
            }
        }
        return $reuslt;
    }
    protected function formatConstraint(){

        $reuslt = '';
        foreach($this->colsMigrationRelation as $key => $value){
            $reuslt .= '$table->foreign("'.$value.'") ->references("id")->on("'.$key.'")
            ->onDelete("cascade");';
            $reuslt .= "\n\t\t\t";
        }

        return $reuslt;
    }


}
