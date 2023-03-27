<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\History;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        $date1        = strtotime(date('Y-m-d'));
        $date2        = $date1 + 86400;

        return [
            'fuel'              => rand(1000, 5000),
            'start_date'        => date('Y-m-d', $date1),
            'end_date'          => date('Y-m-d', $date2),
            'distance'          => rand(10000, 1000000),
            'description'       => $this->faker->paragraph,
            'admin_id'          => rand(2,3),
            'vehicle_id'        => rand(1,20),
            'employee_id'       => rand(1,20),
            'spv_employee_id'   => rand(4,5),
            'spv_admin_id'      => rand(6,7),
        ];
    }
}