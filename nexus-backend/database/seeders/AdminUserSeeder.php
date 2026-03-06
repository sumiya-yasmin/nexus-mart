<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       \App\Models\User::updateOrCreate(
        ['email' => 'admin@nexusmart.com'],
        [
            'name' => 'Nexus Admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]
    );
    }
}
