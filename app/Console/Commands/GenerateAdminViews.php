<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateAdminViews extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:adminViews {name} {--cols=} {--icons=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate Admin Views';
    protected $colsMigration = [];
    protected $icon = 'fa fa-users';

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
        if($this->option('icons')){
            $this->icon = $this->option('icons');
        }
        $this->createViews($ClassName);
        $this->line('Done create '.$ClassName.' Views');
    }

    protected function createViews($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Views'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Views'), 0777, true);
        }
        $Index = app_path('Modules/' . $ClassName . '/Views/' . 'list.blade.php');
        $Edit = app_path('Modules/' . $ClassName . '/Views/' . 'add_edit.blade.php');
        $Menu = app_path('Modules/' . $ClassName . '/Views/' . 'menu.blade.php');
        $IndexStub = __DIR__ . '/stubs/index.stub';
        $EditStub = __DIR__ . '/stubs/edit.stub';
        $menustub = __DIR__ . '/stubs/menu.stub';
//        $ViewStub = __DIR__ . '/stubs/view.stub';
        $this->line('Done create views ' . $ClassName);
        $this->files->put($Index, $this->buildView($ClassName, $IndexStub));
        $this->files->put($Edit, $this->buildView($ClassName, $EditStub));
        $this->files->put($Menu, $this->buildView($ClassName, $menustub));
    }

    protected function CreateOnView($view,$ClassName)
    {
        $path = base_path('resources/views/' . $ClassName . '/' . $view . '.blade.php');
        $this->files->put($path, $this->buildView($ClassName, __DIR__ . '/stubs/' . $view . '.stub'));
        $this->line('Done create view .');
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
        $Route = $name;
        $viewdata = $this->viewdataConten();
        $Tabledcols = $this->Tabledcols('col');
        $HeadFileds = $this->Tabledcols('head');
        $Tabledcolsview = $this->Tabledcols('view');
        $this->replaceView($stub, 'DummyView', $name);
        $this->replaceView($stub, 'ViewContent', $viewdata);
        $this->replaceView($stub, 'Tabledcols', $Tabledcols);
        $this->replaceView($stub, 'myMIco', $this->icon);

        $this->replaceView($stub, 'Tabledcoview', $Tabledcolsview);
        $this->replaceView($stub, 'HeadFileds', $HeadFileds);
        return $this->replaceView($stub, 'Route', $Route);
    }

    protected function viewdataConten(){

        $reuslt = '';
        foreach($this->colsMigration as $key => $value){

            $reuslt .= "<div class=".'"form-group{{ $errors->has('."'".$key."') ? ' has-error' : '' }}".'">';
            $reuslt .="\n\t\t\t";
            $reuslt .= '<label for="userName">'.$key.'</label>';
            $reuslt .="\n\t\t\t";
            $reuslt .=  '<input name="'.$key.'" class="form-control" id="userName" placeholder="" value="'."{{ inputValue('".$key."'".' , $data) }}">';
            $reuslt .="\n\t\t\t";
            $reuslt .= "@errors('".$key."'".')';
            $reuslt .="\n\t\t\t";
            $reuslt .="</div>";
            $reuslt .="\n\t\t\t";

        }
        return $reuslt;
    }

    protected function Tabledcols($type){
        $reuslt = '';

        foreach($this->colsMigration as $key => $value){

            if($type == 'col'){
                $reuslt .= '<td> {{  $val->'.$key.' }} </td>';
                $reuslt .="\n\t\t\t";
            }elseif ($type == 'view'){
                $reuslt .= '<td> @{{  val.'.$key.' }} </td>';
                $reuslt .="\n\t\t\t";
            }
            else{
                $reuslt .= '<th>'.$key.'</th>';
                $reuslt .="\n\t\t\t";
            }


        }
        return $reuslt;
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
}
