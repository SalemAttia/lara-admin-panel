<?php

namespace App\Modules\Roles\Middleware;
use App\Modules\Roles\Models\Role;
use Closure;

class Roles
{
    public function handle($request, Closure $next){
        $userRole = \Auth::guard('dashboard')->user()->role;
        if($userRole != 'super.admin'){
            $name = \Route::currentRouteName();
            $roles = Role::where('slug', $userRole)->first()->actions;
            if($name != 'admin.' && !in_array($name, $roles)) {
                return redirect('/admin/not-have-access');
            }
        }
        return $next($request);
//        $route =\ Route::current();
//        $name = \Route::currentRouteName();
//        $action = \Route::currentRouteAction();
    }
}
