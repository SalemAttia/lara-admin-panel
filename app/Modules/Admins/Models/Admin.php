<?php
namespace App\Modules\Admins\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class Admin
 * @package App\Modules\Admins\Models
 */
class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'admins';
    /**
     * @var string
     */
    protected $redirectTo = '/admin';
    /**
     * @var string
     */
    protected $guard = 'dashboard';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $casts = [

    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roles(){

        return $this->hasOne('App\Modules\Roles\Models\Role', 'slug', 'role');
    }

    /**
     * @param $role
     * @return bool
     */
    public function isRole($role){
        return $this->role == $role;
    }
}
