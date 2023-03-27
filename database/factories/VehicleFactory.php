<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Fakecar;
use App\Models\Vehicle;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        $this->faker->addProvider(new Fakecar($this->faker));
        $vehicle = $this->faker->vehicleArray();

        $date1        = strtotime(date('Y-m-d'));
        $date2        = $date1 + 86400;
        $serviceDate  = rand($date1, $date2);
        
        $type         = ['people', 'goods'];

        return [
            'name'              => $vehicle['brand'] .' - '. $vehicle['model'],
            'type'              => $type[array_rand($type)],
            'schedule_service'  => date('Y-m-d', $serviceDate),
            'created_at'        => date('Y-m-d H:i:s'), 
            'updated_at'        => date('Y-m-d H:i:s')
        ];
    }
}
