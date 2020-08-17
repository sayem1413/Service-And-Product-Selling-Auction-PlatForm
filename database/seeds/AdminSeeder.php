<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'Admin';
        $email = 'admin@gmail.com';
        $password = '123456789';
        $adminMailCheck = DB::table('admins')->where('email', $email)->first();
        if ( !$adminMailCheck ) {
            Admin::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
        }
    }
}
