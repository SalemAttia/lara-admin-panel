<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateAdminModule extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:adminModule {name} {--cols=} {--filter=} {--relation=} {--fRelation=} {--many=} {--xlx=} {--icons=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate complete Admin Module';
    protected $colsMigration = [];
    protected $colsXlx = [];
    protected $colsMany = [];
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

        $this->callSilent('generate:adminViews', [
            'name' => $ClassName,
            '--cols' => $this->option('cols'),
            '--icons' => $this->option('icons')
        ]);

        $this->callSilent('generate:routes', [
            'name' => $ClassName
        ]);

        $this->callSilent('generate:model', [
            'name' => $ClassName,
            '--cols' => $this->option('cols'),
            '--filter' => $this->option('filter'),
            '--fRelation' => $this->option('fRelation'),
            '--xlx' => $this->option('xlx')
        ]);
        $this->callSilent('generate:controller', [
            'name' => $ClassName
        ]);
//        $this->callSilent('generate:adminTransformer', [
//            'name' => $ClassName
//        ]);


        $this->callSilent('generate:xlx', [
            'name' => $ClassName,
            '--xlx' => $this->option('xlx')
        ]);

        $this->callSilent('generate:apiController', [
            'name' => $ClassName
        ]);
        $this->callSilent('generate:database', [
            'name' => $ClassName,
            '--cols' => $this->option('cols'),
            '--relation' => $this->option('relation'),
            '--many' => $this->option('many')
        ]);
        $this->callSilent('generate:lang', [
            'name' => $ClassName
        ]);
        $this->callSilent('generate:config', [
            'name' => $ClassName
        ]);
        $this->callSilent('generate:helper', [
            'name' => $ClassName
        ]);
        $this->line('Done create Admin module');
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

    protected function createController($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Controller'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Controller'), 0777, true);
        }
        $controllerName = $ClassName . 'Controller';
        $repo = $ClassName . 'Repo';
        $transformer = $ClassName . 'Resource';
        $modelName = str_replace('s', '', $ClassName);
        $modelName = str_replace('ies', 'y', $modelName);
        $viewName = $ClassName;
        $path = app_path('Modules/' . $ClassName . '/Controller/' . $ClassName . 'Controller.php');
        $this->line('Done create Controller ' . $ClassName);
        $this->files->put($path, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/controller.stub' . ''));

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

        $this->files->put($Factory, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/factory.stub'));
        $this->files->put($Migration, $this->buildClassControllerDb($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/migration.stub'));
        $this->files->put($Seeder, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/seeder.stub'));
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

    protected function createViews($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Views'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Views'), 0777, true);
        }
        $Index = app_path('Modules/' . $ClassName . '/Views/' . 'list.blade.php');
        $Edit = app_path('Modules/' . $ClassName . '/Views/' . 'add_edit.blade.php');
//        $View = app_path('Modules/' . $ClassName . '/Views/' . 'view.blade.php');
        $IndexStub = __DIR__ . '/stubs/index.stub';
        $EditStub = __DIR__ . '/stubs/edit.stub';
//        $ViewStub = __DIR__ . '/stubs/view.stub';
        $this->line('Done create views ' . $ClassName);
        $this->files->put($Index, $this->buildView($ClassName, $IndexStub));
        $this->files->put($Edit, $this->buildView($ClassName, $EditStub));
//        $this->files->put($View, $this->buildView($ClassName, $ViewStub));
    }

    protected function createLang($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Lang/en/'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Lang/en/'), 0777, true);
        }
        if (!file_exists(app_path('Modules/' . $ClassName . '/Lang/ar/'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Lang/ar/'), 0777, true);
        }
        $pathEn = app_path('Modules/' . $ClassName . '/Lang/en/home.php');
        $pathAr = app_path('Modules/' . $ClassName . '/Lang/ar/home.php');
        $this->line('Done create Model ' . $ClassName);
        $this->files->put($pathEn, $this->buildView($ClassName, __DIR__ . '/stubs/lang.stub'));
        $this->files->put($pathAr, $this->buildView($ClassName, __DIR__ . '/stubs/lang.stub'));
    }

    protected function createMiddleware($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Middleware'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Middleware'), 0777, true);
        }
        $path = app_path('Modules/' . $ClassName . '/Middleware/' . $ClassName . '.php');
        $this->line('Done create Model ' . $ClassName);
        $this->files->put($path, $this->buildView($ClassName, __DIR__ . '/stubs/lang.stub'));
    }

    protected function appendRoutes($ClassName)
    {

        $Web = app_path('Modules/' . $ClassName . '/web.php');
        $Api = app_path('Modules/' . $ClassName . '/api.php');
        $this->line('Done create Routes ' . $ClassName);
        $this->files->append($Web, $this->buildRoute($ClassName, __DIR__ . '/stubs/web.stub'));
        $this->files->append($Api, $this->buildRoute($ClassName, __DIR__ . '/stubs/apiRoutes.stub'));
    }

    protected function createConfig($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/'))) {
            mkdir(app_path('Modules/' . $ClassName . '/'), 0777, true);
        }
        $path = app_path('Modules/' . $ClassName . '/config.php');
        $this->line('Done create Config ' . $ClassName);
        $this->files->put($path, $this->buildView($ClassName, __DIR__ . '/stubs/config.stub'));
    }

    protected function createHelper($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/'))) {
            mkdir(app_path('Modules/' . $ClassName . '/'), 0777, true);
        }
        $path = app_path('Modules/' . $ClassName . '/helper.php');
        $this->line('Done create helper ' . $ClassName);
        $this->files->put($path, $this->buildView($ClassName, __DIR__ . '/stubs/helper.stub'));
    }

    protected function CreateOnView($view, $ClassName)
    {
        $path = app_path('Modules/' . $ClassName . '/Views/' . $view . '.blade.php');
        $this->line('Done create views');
        $this->files->put($path, $this->buildView($ClassName, __DIR__ . '/stubs/' . $view . '.stub'));
    }

    protected function buildRoute($ClassName, $stub)
    {
        $stub = $this->files->get($stub);
        return $this->replace($stub, 'DummyRoute', $ClassName)
            ->replaceView($stub, 'DummyView', $ClassName);
    }

    protected function buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, $stub)
    {
        $stub = $this->files->get($stub);
        $fileds = $this->reFormatRequest();
        return $this->replace($stub, 'DummyModel', $modelName)
            ->replace($stub , 'DummyFields', $fileds)
            ->replace($stub, 'DummyView', $viewName)
            ->replace($stub, 'DummyRepo', $repo)
            ->replace($stub, 'DummyTransformer', $transformer)
            ->replaceNamespace($stub, $ClassName)
            ->replaceClass($stub, $controllerName);
    }

    protected function buildClassControllerDb($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, $stub)
    {
        $stub = $this->files->get($stub);
        $fileds = $this->reFormatRequest();
        return $this->replace($stub, 'DummyModel', lcfirst($this->getPluralPrase($modelName)))
            ->replace($stub , 'ModelClassName', $modelName)
            ->replace($stub , 'DummyFields', $fileds)
            ->replace($stub, 'DummyView', $viewName)
            ->replace($stub, 'DummyRepo', $repo)
            ->replace($stub, 'DummyTransformer', $transformer)
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

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/model.stub';
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
//        $CurrentDateFrom2Month = date("Y-m-d" , strtotime("-2 month"));
//        DB::table('sys_attendance')->where('date','<',$CurrentDateFrom2Month)->delete();
        return $stub;
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
