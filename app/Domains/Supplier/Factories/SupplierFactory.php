<?php

namespace App\Domains\Supplier\Factories;

use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Models\SupplierItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Supplier>
 */
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

    public function supplierItem($count = 3)
    {
        return $this->afterCreating(function(Supplier $supplier) use ($count) {
            SupplierItem::factory()
                ->count($count)
                ->for($supplier)
                ->create();
        });
    }
}