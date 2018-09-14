<?php

namespace App\Modules\Roles\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Role
 * @package App\Modules\Roles\Models
 */
class Role extends Model
{
    /**
     * @var string
     */
    protected $table = 'roles';
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var
     */
    protected $role;
    /**
     * @var array
     */
    protected $casts = [
        'actions' => 'array',
        'permissions' => 'array'
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug', 'actions', 'permissions'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admins(){
        return $this->belongsTo('App\Modules\Admins\Models\Admin');
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasAction($role){
        if($this->role == 'not.found') return false;

        if($this->role == 'super.admin') return true;

        if(in_array($role, $this->actions)) return true;

        return false;
    }

    /**
     * @param array $actions
     * @return bool
     */
    public function hasOneAction(array $actions){
        $return = false;
        foreach ($actions as $action){
            if($this->hasAction($action)){
                $return = true;
            }
        }
        return $return;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission){
        if($this->role == 'not.found') return false;

        if($this->role == 'super.admin') return true;

        if(in_array($permission, $this->permissions)) return true;

        return false;
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function hasOnePermission(array $permissions){
        $return = false;
        foreach ($permissions as $permission){
            if($this->hasPermission($permission)){
                $return = true;
            }
        }
        return $return;
    }

    /**
     * @param $role
     * @return $this
     */
    public function setRole($role){
        $this->role = $role;
        return $this;
    }

//    public function setActionsAttribute($value) {
//        $this->attributes['actions'] = json_encode($value);
//    }
//
//    public function getActionsAttribute($value) {
//        return json_decode($value);
//    }
//
//    public function setPermissionsAttribute($value)
//    {
//        $this->attributes['permissions'] = json_encode($value);
//    }
//
//    public function getPermissionsAttribute($value)
//    {
//        return json_decode($value);
//    }


}
