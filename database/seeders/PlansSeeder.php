<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'plans' => 'Basic',
                'description' => 'Basic description',
                'price' => '0',
                'duration' => '0',
                'created_by' => 1,
                'updated_by' => 1,
            ], 
            [
                'plans' => 'Standard',
                'description' => 'Standard description',
                'price' => '3',
                'duration' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'plans' => 'Advance',
                'description' => 'Advance description',
                'price' => '5',
                'duration' => '1',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'plans' => 'Professional',
                'description' => 'Professional description',
                'price' => '10',
                'duration' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ];

        \App\Models\Plan::insert($plans);
    }
}
