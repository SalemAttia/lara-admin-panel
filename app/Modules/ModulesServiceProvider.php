<?php

namespace App\Modules;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class ModulesServiceProvider
 * @package App\Modules
 */
class ModulesServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $namespace = 'App\Modules';

    /**
     *
     */
    public function boot()
    {
        $modules = array_diff(scandir(__DIR__), ['.', '..']);

        if ($key = array_search('Core', $modules)) {
            unset($modules[$key]);
            array_unshift($modules, 'Core');
        }

        if ($key = array_search('Website', $modules)) {
            unset($modules[$key]);
            array_push($modules, 'Website');
        }

        foreach ($modules as $module) {
            $this->loadModules($module);
        }
    }

    /**
     * @param $module
     */
    public function loadModules($module)
    {
        $currentDir = __DIR__ . DIRECTORY_SEPARATOR . $module;
        if (is_dir($currentDir)) {
            $web = $currentDir . DIRECTORY_SEPARATOR . 'web.php';
            $api = $currentDir . DIRECTORY_SEPARATOR . 'api.php';
            $config = $currentDir . DIRECTORY_SEPARATOR . 'config.php';
            $views = $currentDir . DIRECTORY_SEPARATOR . 'Views';
            $lang = $currentDir . DIRECTORY_SEPARATOR . 'Lang';
            $migration = $currentDir . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Migrations';
            $middleware = $currentDir . DIRECTORY_SEPARATOR . 'Middleware';

            if (file_exists($config)) {
                $config = include $config;
                if (!$config['status']) return;

                if (isset($config['autoload'])) {
                    foreach ($config['autoload'] as $f) {
                        include $currentDir . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $f);
                    }
                }

                if(isset($config['menu'])){
                    $menu = file_get_contents($currentDir . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $config['menu']));
                    \DashboardMenu::instance()->add($module, $menu);
                }
            } else {
                return;
            }

            if (file_exists($web)) {
                $this->mapWebRoutes($this->namespace . '\\' . $module . '\Controllers', $web);
            }

            if (file_exists($api)) {
                $this->mapApiRoutes($this->namespace . '\\' . $module . '\Controllers', $api);
            }

            if (is_dir($views) && file_exists($views)) {
                $this->loadViewsFrom($views, $module);
            }

            if (is_dir($lang) && file_exists($lang)) {
                $this->loadTranslationsFrom($lang, $module);
            }

            if (is_dir($middleware) && file_exists($middleware) && isset($config['middleware'])) {
                $this->registerMiddleware($this->app['router'], $config['middleware'], $module);
            }

            if (is_dir($migration)) {
                $this->loadMigrationsFrom($migration);
            }
        }
    }

    /**
     *
     */
    public function register()
    {
        $this->app->singleton(ModulesHelpers::class, function ($app) {
            return new ModulesHelpers($app);
        });
    }

    /**
     * @param $namespace
     * @param $path
     */
    protected function mapWebRoutes($namespace, $path)
    {
        Route::middleware('web')->namespace($namespace)->group($path);
    }

    /**
     * @param $namespace
     * @param $path
     */
    protected function mapApiRoutes($namespace, $path)
    {
        Route::prefix('api')->middleware('api')->namespace($namespace)->group($path);
    }

    /**
     * @param Router $router
     * @param $config
     * @param $module
     */
    public function registerMiddleware(Router $router, $config, $module)
    {
        foreach ($config as $name => $middleware) {
            $class = "App\\Modules\\{$module}\\Middleware\\{$middleware}";
            $router->aliasMiddleware($name, $class);
        }
    }
}