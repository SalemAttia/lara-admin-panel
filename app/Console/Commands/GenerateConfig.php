<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateConfig extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:config {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate config';

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
        $this->createConfig($ClassName);
        $this->line('Done create '.$ClassName.' Config');
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
        return $this->replaceView($stub, 'DummyRoute', $name);
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
