<?php

namespace Database\Seeders;

use App\Domains\Core\Models\UnitOfMeasure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitOfMeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit_of_measures = [
            ['id' => 1, 'name' => 'Piece', 'code' => UnitOfMeasure::CODE_PC, 'symbol' => 'pc'],
            ['id' => 2,'name' => 'Box', 'code' => UnitOfMeasure::CODE_BOX, 'symbol' => 'box'],
        ];

        foreach ($unit_of_measures as $row) {
            UnitOfMeasure::updateOrCreate(
                ['code' => $row['code']],
                $row + ['is_system' => true]
            );
        }
    }
}
