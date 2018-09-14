<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateHelper extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:helper {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate helper';

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
        $this->createHelper($ClassName);
        $this->line('Done create '.$ClassName.' Helper');
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
