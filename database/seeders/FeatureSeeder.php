<?php

namespace Database\Seeders;

use Enterprisesuite\Feature\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            ['key' => 'procurement:pr_approval', 'name' => 'Purchase Request Approval']
        ];

        Feature::upsert(
            $features,
            ['key']
        );
    }
}
