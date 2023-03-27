<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            'admin1', 'admin2', 
            'spv_employee1', 'spv_employee2',
            'spv_admin1', 'spv_admin2'
        ];

        User::create([
            'name'          => 'superadmin',
            'email'         => 'superadmin@gmail.com',
            'password'      => bcrypt('rahasia'),
            'username'      => 'superadmin',
            'phone'         => '08' . rand(1000000000,5000000000),
            'age'           => rand(20, 50),
            'role'          => 'superadmin',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);

        foreach ($users as $user) {
            User::create(
                [
                    'name'          => $user,
                    'email'         => $user . '@gmail.com',
                    'password'      => bcrypt('rahasia'),
                    'username'      => $user,
                    'phone'         => '08' . rand(1000000000,5000000000),
                    'age'           => rand(20, 50),
                    'role'          => $user == 'admin1' || $user == 'admin2' ? 'admin' : 
                                        ($user == 'spv_employee1' || $user == 'spv_employee2' ? 'spv_employee' : 'spv_admin'),
                    'created_at'    => date('Y-m-d H:i:s'), 
                    'updated_at'    => date('Y-m-d H:i:s') 
                ],
            );
        }
    }
}