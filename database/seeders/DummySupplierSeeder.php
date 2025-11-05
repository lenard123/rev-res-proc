<?php

namespace Database\Seeders;

use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Seeder;

class DummySupplierSeeder extends Seeder
{
    public const SUPPLIER_PILOT_ID = 1;
    public const SUPPLIER_PENTEL_ID = 2;

    public function run(): void
    {
        Supplier::insert([
            [
                'id' => self::SUPPLIER_PILOT_ID,
                'code' => 'SPLR-0001',
                'name' => 'Pilot',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_PENTEL_ID,
                'code' => 'SPLR-0002',
                'name' => 'Pentel',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);        
    }
}