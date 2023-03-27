<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        return $this->call([
            UserSeeder::class,
            EmployeeSeeder::class,
            VehicleSeeder::class,
            HistorySeeder::class,
        ]);
    }
}
