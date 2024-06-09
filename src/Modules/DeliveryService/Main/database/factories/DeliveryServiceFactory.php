<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DeliveryServiceFactory extends Factory
{
    public $model = DeliveryServiceModel::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->uuid,
            'name' => 'Raketa',
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
