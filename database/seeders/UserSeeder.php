<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'manager',
            'role_id' => 1,
            'email' => 'manager@company.com',
            'password' => Hash::make('12345')
        ]);
        User::create([
            'name' => 'user',
            'role_id' => 2,
            'email' => 'clint@company.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
