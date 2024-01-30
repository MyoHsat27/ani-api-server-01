<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['basic-user', 'vip-user', 'author', 'admin', 'super-admin'];
        foreach ($roles as $role) {
            Role::factory()->create(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
