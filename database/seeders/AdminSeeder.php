<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@banksampah.com'],
            [
                'name' => 'Administrator',
                'phone' => '081234567890',
                'address' => 'Bank Sampah',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => true,
                'rank' => 'Bronze',
                'current_point' => 0,
                'total_point' => 0,
            ]
        );
    }
}