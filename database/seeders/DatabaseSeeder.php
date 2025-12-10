<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            ['name' => 'Admin', 'description' => 'System Administrator'],
            ['name' => 'Branch Manager', 'description' => 'Branch Manager'],
            ['name' => 'Accountant', 'description' => 'Accountant'],
            ['name' => 'Warden', 'description' => 'Hostel Warden'],
            ['name' => 'Resident', 'description' => 'Hostel Resident'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Create admin user
        $adminRole = Role::where('name', 'Admin')->first();
        
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@hostel.com',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);
        $this->call([
            // Your existing seeders
            CommonTypesSeeder::class,
        ]);

    }
}