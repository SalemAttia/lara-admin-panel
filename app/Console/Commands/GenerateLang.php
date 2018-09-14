<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\File;

class GenerateLang extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:lang {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate lang';

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
        $this->createLang($ClassName);
        $this->line('Done create '.$ClassName.' Lang');
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
