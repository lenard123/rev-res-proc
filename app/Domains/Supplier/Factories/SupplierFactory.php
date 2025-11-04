<?php

namespace App\Domains\Supplier\Factories;

use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'code' => Str::uuid()->toString(),
            'name' => $this->faker->company(),
        ];
    }
}