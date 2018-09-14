<?php

use Illuminate\Database\Seeder;
use App\Modules\Roles\Models\Role;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::create([
            'name' => 'super.admin',
            'description' => 'super admin',
            'actions' => '',
            'permissions' => '[]',
            'slug' => 'super.admin'
        ]);

    }
}