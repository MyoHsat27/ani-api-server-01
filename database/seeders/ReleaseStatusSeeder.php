<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReleaseStatus;

class ReleaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Release Status Types
        $releaseStatusTypes = ['on-going', 'coming-soon', 'finished', 'dropped', 'hiatus'];
        foreach ($releaseStatusTypes as $type) {
            ReleaseStatus::factory()->create([
                'status' => $type,
            ]);
        }
    }
}
