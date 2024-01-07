<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Roles
        $roles = ['user-basic', 'user-premium', 'author', 'admin', 'superadmin'];
        foreach ($roles as $role) {
            Role::factory()->create([
                'name'        => $role,
                'slug'        => Str::slug($role),
                'description' => "gj fioewjf oehwfio hewio fhiowehf ioweh fiohweo fhwe",
            ]);
        }

    }
}
