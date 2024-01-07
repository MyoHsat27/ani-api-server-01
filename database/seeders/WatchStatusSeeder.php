<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WatchStatus;

class WatchStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Watch Status Types
        $watchStatusTypes = ['currently', 'completed', 'dropped', 'on-hold', 'plan-to-watch'];
        foreach ($watchStatusTypes as $type) {
            WatchStatus::factory()->create([
                'status' => $type,
            ]);
        }
    }
}
