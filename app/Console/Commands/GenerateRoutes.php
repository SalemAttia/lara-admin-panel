<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateRoutes extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:routes {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate Admin Routes';

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
        $this->appendRoutes($ClassName);
        $this->line('Done create '.$ClassName.' Route');
    }

    protected function appendRoutes($ClassName)
    {
        $Web = app_path('Modules/' . $ClassName . '/web.php');
        $Api = app_path('Modules/' . $ClassName . '/api.php');
        $this->line('Done create Routes ' . $ClassName);
        $this->files->append($Web, $this->buildRoute($ClassName, __DIR__ . '/stubs/web.stub'));
        $this->files->append($Api, $this->buildRoute($ClassName, __DIR__ . '/stubs/apiRoutes.stub'));
    }

    protected function buildRoute($ClassName, $stub)
    {
        $stub = $this->files->get($stub);
        return $this->replace($stub, 'DummyRoute', $ClassName)
            ->replaceView($stub, 'DummyView', $ClassName);
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
