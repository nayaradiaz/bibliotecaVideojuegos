<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin');
        $user = User::create([
            'name' => 'nayara',
            'email' => 'nayara@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('write');
    }
}
