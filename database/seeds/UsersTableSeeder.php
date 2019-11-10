<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = "password";

        User::create([
            'name' => 'Admin',
            'email' => 'jean-mathieu.emond@jmdev.ca',
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
}
