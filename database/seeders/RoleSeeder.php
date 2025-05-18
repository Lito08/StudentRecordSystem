<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. roles
        foreach (['admin','lecturer','student'] as $r) {
            Role::firstOrCreate(['name' => $r]);
        }

        // 2. first admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'System Admin', 'password' => bcrypt('Password123!')]
        );
        $admin->assignRole('admin');
    }
}
