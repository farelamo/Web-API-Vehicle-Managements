<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->name,
            'phone'         => '08' . rand(1000000000,5000000000),
            'age'           => rand(20, 50),
            'address'       => $this->faker->address,
            'created_at'    => date('Y-m-d H:i:s'), 
            'updated_at'    => date('Y-m-d H:i:s') 
        ];
    }
}
