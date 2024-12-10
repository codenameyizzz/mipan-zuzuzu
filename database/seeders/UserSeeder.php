<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'role' => 'admin',
        ]);

        // Membuat Alumni
        User::create([
            'name' => 'Alumni User',
            'email' => 'alumni@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'role' => 'alumni',
        ]);
    }
}
