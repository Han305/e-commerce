<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
        \App\Models\User::factory()->create([
            'name' => 'User',
            'username' => 'Test User',
            'email' => 'test@example.com',
            'telp' => '123456',
            'password' => bcrypt('123'),
            'category' => 'user',
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'telp' => '123456',
            'password' => bcrypt('123'),
            'category' => 'admin',
        ]);
    }
}