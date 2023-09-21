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
                'email'          => 'administrator@gmail.com',
                'phone'          => '09797809783',
                'password'       => bcrypt('administrator@123'),
                'profile_image'  => '/user-avatar.png',
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Super Admin',
                'email'          => 'admin@gmail.com',
                'phone'          => '09406405232',
                'password'       => bcrypt('password'),
                'profile_image'  => '/user-avatar.png',
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Manager',
                'email'          => 'manager@gmail.com',
                'phone'          => '09406405233',
                'password'       => bcrypt('password'),
                'profile_image'  => '/user-avatar.png',
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Staff',
                'email'          => 'staff@gmail.com',
                'phone'          => '09406405234',
                'password'       => bcrypt('password'),
                'profile_image'  => '/user-avatar.png',
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'name'           => 'User',
                'email'          => 'user@gmail.com',
                'phone'          => '09406405235',
                'password'       => bcrypt('password'),
                'profile_image'  => '/user-avatar.png',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
