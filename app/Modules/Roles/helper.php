<?php

use App\Modules\Admins\Models\Admin;
use \App\Modules\ModulesHelpers;
if(!function_exists('listOfRoles')) {

    function listOfRoles(callable $code, $roles = null, $index = 0, $parent = '')
    {
        $roles = $roles ?? ModulesHelpers::getRouteList()['admin'];
        foreach ($roles as $role => $name) {

            if (is_array($name)) {
                if ($index++ == 0) {
                    echo "<div style=\"list-style: none;padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef\">";
                    echo "<ul class='list'><li class='title'><h3>$parent  $role</h3></li>";
                } else {
                    echo "<div class='box box-default sub'>";
                    echo "<ul style=\"list-style: none;padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef\"><li class='title'><h4>$parent  $role</h4></li>";
                }
//            echo "<hr style='border:2px solid #ccc'/>";
                listOfRoles($code, $name, $index, $role . ' / ');
//            echo "<hr style='border:2px solid #ccc'/>";
                echo '</ul></div>';
                $index = 0;
            } else {
                $code($role, $name);
            }
        }
    }
}
if(!function_exists('listOfPermissions')) {

    function listOfPermissions(callable $code)
    {
        $permissions = \App\Modules\Roles\Models\Permission::all();
        foreach ($permissions as $permission) {
            $code($permission);
        }
    }
}
//getAdminRoles(4)->hasAction('admin.admins.index');
if(!function_exists('getAdminRoles')) {

    function getAdminRoles($id)
    {
        if ($roles = ModulesHelpers::getData('UserRole:' . $id)) {
            return $roles;
        }
        $roles = Admin::find($id);
        if(!is_null($roles) && $roles->role == 'super.admin'){
            $roles = (new \App\Modules\Roles\Models\Role)->setRole('super.admin');
        }elseif (!is_null($roles) && isset($roles->roles)){
            $roles = $roles->roles;
        }else{
            $roles = (new \App\Modules\Roles\Models\Role)->setRole('not.found');
        }

        ModulesHelpers::setData('UserRole:' . $id, $roles);
        return $roles;
    }
}
if(!function_exists('getCurrentAdminRoles')) {

    function getCurrentAdminRoles(){
        return getAdminRoles(getCurrentAdmin('id'));
    }
}
