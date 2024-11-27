<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $role = Role::create(['name' => 'usuario', 'guard_name' => 'api']);
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role = Role::create(['name' => 'usuario', 'guard_name' => 'web']);
    }
}
