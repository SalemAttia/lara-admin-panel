<?php
use Illuminate\Database\Seeder;
use App\Modules\Admins\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $password = 'secret';

        Admin::create([
            'name' => 'Judith',
            'email' => 'Judith@test.com',
            'password' => $password,
            'user_name' => 'Judith',
            'role' => 'super.admin'
        ]);

    }
}