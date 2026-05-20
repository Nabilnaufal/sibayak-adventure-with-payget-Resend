<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'faqiharif4@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Nabil',
            'email' => 'naufalnabil@students.polmed.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}
