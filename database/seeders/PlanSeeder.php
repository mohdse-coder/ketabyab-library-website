<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::firstOrCreate(
            ['is_default' => true],
            [
                'name' => 'Free',
                'max_libraries' => 1,
                'max_books' => 100,
                'price' => 0,
            ]
        );
    }
}
