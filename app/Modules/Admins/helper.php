<?php

use App\Modules\ModulesHelpers;
if(!function_exists('getCurrentAdmin')) {
    function getCurrentAdmin($column = null)
    {
        if ($admin = ModulesHelpers::getData('CurrentAdmin')) {
            return $column ? $admin->{$column} : $admin;
        }
        $admin = Auth::guard('dashboard')->user();
        ModulesHelpers::setData('CurrentAdmin', $admin);
        return $column ? $admin->{$column} : $admin;
    }
}


