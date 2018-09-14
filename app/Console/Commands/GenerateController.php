<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate Admin Controller';

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
        $this->createController($ClassName);
        $this->line('Done create '.$ClassName.' Controller');
    }

    protected function createController($ClassName)
    {
        if (!file_exists(app_path('Modules/' . $ClassName . '/Controllers'))) {
            mkdir(app_path('Modules/' . $ClassName . '/Controllers'), 0777, true);
        }
        $controllerName = $ClassName . 'Controller';
        $repo = $ClassName . 'Repo';
        $transformer = $ClassName . 'Resource';
        $modelName =  $ClassName;
        $modelName = str_replace('ies', 'y', $modelName);
        $viewName = $ClassName;
        $path = app_path('Modules/' . $ClassName . '/Controllers/' . $ClassName . 'Controller.php');
        $this->line('Done create Controllers ' . $ClassName);
        $this->files->put($path, $this->buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, __DIR__ . '/stubs/controller.stub' . ''));

    }

    protected function buildClassController($ClassName, $controllerName, $modelName, $viewName, $repo, $transformer, $stub)
    {
        $stub = $this->files->get($stub);
        $DummyModelSmall = $ClassName;
        $Model = ucfirst($ClassName);
        $Route = $ClassName;
        return $this->replace($stub, 'DummyModel', $modelName)
            ->replace($stub, 'DummyView', $viewName)
            ->replace($stub, 'DummyRepo', $repo)
            ->replace($stub, 'Route', $Route)
            ->replace($stub, 'Modelname', $Model)
            ->replace($stub, 'DummSmall', $DummyModelSmall)
            ->replace($stub, 'DummyTransformer', $transformer)
            ->replaceNamespace($stub, $ClassName)
            ->replaceClass($stub, $controllerName);
    }


    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

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
}
