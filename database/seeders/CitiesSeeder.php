<?php

namespace Database\Seeders;
// database/seeders/CitiesSeeder.php
use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'Москва'],
            ['name' => 'Санкт-Петербург'],
            ['name' => 'Новосибирск'],
            ['name' => 'Екатеринбург'],
            ['name' => 'Казань'],
            ['name' => 'Нижний Новгород'],
            ['name' => 'Челябинск'],
            ['name' => 'Самара'],
            ['name' => 'Омск'],
            ['name' => 'Ростов-на-Дону'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}