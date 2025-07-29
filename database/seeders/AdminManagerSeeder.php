<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// database/seeders/AdminManagerSeeder.php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminManagerSeeder extends Seeder
{
    public function run()
    {
        // Создаем администратора
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'company' => 'Администрация',
            'phone' => '+79999999999',
            'city_id' => 1 // ID города из таблицы cities
        ]);

        // Создаем менеджера
        User::create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'company' => 'Отдел продаж',
            'phone' => '+78888888888',
            'city_id' => 1
        ]);
    }
}