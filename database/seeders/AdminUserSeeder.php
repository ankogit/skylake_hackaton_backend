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
        User::query()->create([
            'first_name' => 'Админ',
            'last_name' => '',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123123123'),
        ]);

        User::query()->create([
            "email" => "ansbeliaev@gmail.com",
            "first_name" => "Андрей",
            "last_name" => "Беляев",
            "password" => "123123123"
        ]);
    }
}
