<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Administrator',
                'phone'          => 'administrator@gmail.com',
                'password'       => bcrypt('administrator@123'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Super Admin',
                'phone'          => 'admin@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Manager',
                'phone'          => 'manager@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Staff',
                'phone'          => 'staff@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'name'           => 'User',
                'phone'          => 'user@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
