<?php namespace App\Modules;
use Config;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class ModulesHelpers
 * @package App\Modules
 */
class ModulesHelpers extends ServiceProvider
{
    /**
     * @var array
     */
    private static $functions = [];

    /**
     * @param $name
     * @param $val
     */
    public static function create($name, $val){
        static::$functions[$name] = $val;
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed|null
     */
    public static function __callStatic($name, $args)
    {
        return  isset(static::$functions[$name]) && is_callable(static::$functions[$name])
            ? call_user_func_array(static::$functions[$name], $args) : null;
    }

}