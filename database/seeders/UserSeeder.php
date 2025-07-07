<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'The 1st User',
            'email' => 'user@gmail.com',
            'password' => '123456'
        ]);

        User::create([
            'name' => 'The 1st Admin',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'role' => 'admin',
        ]);
    }
}