<?php
/**
 * Created by PhpStorm.
 * User: salem
 * Date: 7/31/18
 * Time: 12:57 PM
 */


namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateExcel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:xlx {name} {--xlx=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate xlx';

    protected $colsFiled = [];

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
        if($this->option('xlx')){
            $this->setCols();
        }

        $this->createModel($ClassName);
        $this->line('Done create  XlX');

    }

    protected function setCols(){
        $cols = $this->option('xlx');
        $this->colsFiled = explode(',' , $cols);

    }

    protected function createModel($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Controllers/'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Controllers/'), 0777, true);
        }
        $path = app_path('Modules/' . $ClassName . '/Controllers/ExportDataExcel.php');
        $Web = app_path('Modules/' . $ClassName . '/web.php');

        $this->files->put($path, $this->buildClass($ClassName));

        $this->files->append($Web, $this->buildRoute($ClassName, __DIR__ . '/stubs/appendweb.stub'));
    }


    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $datafiled = $this->filleddata();
        $ItemHead = $this->ItemHead();
        $outputdata = $this->outputdata();
        $readxData = $this->readxData();
        $savetodb = $this->savetodb();
        $faildata = $this->faildata();

        $this->replace( $stub, 'FilledsData',$datafiled);
        $this->replace( $stub, 'DummyModel',$name);
        $this->replace( $stub, 'ItemHead',$ItemHead);
        $this->replace( $stub, 'outputdata',$outputdata);
        $this->replace( $stub, 'readxdata',$readxData);
        $this->replace( $stub, 'savetodb',$savetodb);
        $this->replace( $stub, 'faildata',$faildata);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

    }

    protected function buildRoute($ClassName, $stub)
    {
        $stub = $this->files->get($stub);
        return $this->replace($stub, 'DummyRoute', $ClassName)
            ->replaceView($stub, 'DummyView', $ClassName);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/excelsheetfile.stub';
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
        $result = '';
        $i =0;
        foreach ($this->colsFiled as $filed){
            $result .= "'".$filed."' => \$data['".$filed."']";
            $i++;
            if(count($this->colsFiled ) != $i){
                $result .= ',';
            }


        }
        return $result;
    }

    protected function ItemHead(){
        $result = '';
        $i =0;
        foreach ($this->colsFiled as $filed){
            $result .= "'".$filed."'";
            $i++;
            if(count($this->colsFiled ) != $i){
                $result .= ',';

            }


        }
        return $result;
    }

    protected function outputdata(){
        $result = '';
        $i =0;
        foreach ($this->colsFiled as $filed){
            $result .= "\$item['".$filed."']";
            $i++;
            if(count($this->colsFiled ) != $i){
                $result .= ',';

            }

        }
        return $result;
    }

    protected function faildata(){
        $result = '';
        $i =0;
        foreach ($this->colsFiled as $filed){
            if($filed != 'id'){

                $result .= "\$item->".$filed;
                $i++;
                if(count($this->colsFiled )-1 != $i){
                    $result .= ',';

                }
            }

        }
        return $result;
    }

    protected function readxData(){
        $result = '';
        $i =0;
        foreach ($this->colsFiled as $filed){
            $result .= "\$excel_record['".$filed."'] = \$value->".$filed.";";
            $result .= "\n\t\t\t";

        }
        return $result;
    }

    protected function savetodb()
    {
        $result = '';
        $i =0;
        foreach ($this->colsFiled as $filed){
            if($filed != 'id'){

                $result .= "\$subject->".$filed." = \$request->".$filed.";";
                $result .= "\n\t\t\t";

            }

        }
        return $result;
    }

}
