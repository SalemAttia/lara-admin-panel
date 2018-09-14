<?php

namespace App\Modules\Roles\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Modules\Roles\Models
 */
class Permission extends Model
{
    /**
     * @var string
     */
    protected $table = 'permissions';
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug'
    ];

}
