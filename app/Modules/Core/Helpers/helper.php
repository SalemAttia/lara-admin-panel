<?php
use \App\Modules\ModulesHelpers;
use \Illuminate\Support\Arr;
ModulesHelpers::create('getRouteList', function(){
    $routes = [];
    foreach (\Route::getRoutes() as $route){
        if($route->getName() == 'admin.' || strpos($route->getName(), 'admin.') === false){
            continue;
        }
//        $routes[$route->getName()] = $route;
        Arr::set($routes, $route->getName(), $route->getName());
//        $value->getMethods()[0];
//        $value->getPath();
//        $value->getName();
//        $value->getActionName();

    }
    return $routes;
});

ModulesHelpers::create('setData', function($key, $val){
    $this->app['config']->set('modulesData.' . $key, $val);
});

ModulesHelpers::create('getData', function($key){
    return $this->app['config']->get('modulesData.'.$key);
});

if(!function_exists('inputValue')){
    function inputValue($value, $objectOrArray = null, $default = null){
        $default = $default ?? old($value);
        if($objectOrArray){
            if(is_array($objectOrArray))  $return =  $objectOrArray[$value] ?? $default;
            if(is_object($objectOrArray))  $return =  $objectOrArray->$value ?? $default;
        }
        return $return ?? $default;
    }

}
if(!function_exists('formAction')){

    function formAction($action, $route, $id)
    {
        switch ($action){
            case 'add':
                return route($route.'.store');
            case 'edit':
                return route($route.'.update', is_array($id) ? $id : ['id' => $id]);
            default:
                return $action;
        }
    }
}
if(!function_exists('formMethod')){

    function formMethod($action){
        return $action == 'edit' ? 'PUT' : 'POST';
    }
}

