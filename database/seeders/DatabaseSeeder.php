<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\City;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ContactSetting;
use App\Models\User;

use App\Models\CustomerRequest;
use App\Models\SellerResponse;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // CitiesSeeder::class, // Если у вас есть сидер для городов
            // AdminManagerSeeder::class,
            // Другие сидеры...
        ]);

        $faker = Faker::create('ru_RU');

        // Создаем или получаем необходимые связанные данные
        $brands = Brand::pluck('id')->toArray();
        $manufacturers = Manufacturer::pluck('id')->toArray();
        $cities = City::pluck('id')->toArray();
        $suppliers = User::where('role', 'supplier')->pluck('id')->toArray();

        if (empty($brands)) {
            $brands = Brand::factory()->count(5)->create()->pluck('id')->toArray();
        }

        if (empty($manufacturers)) {
            $manufacturers = Manufacturer::factory()->count(5)->create()->pluck('id')->toArray();
        }

        if (empty($cities)) {
            $cities = City::factory()->count(5)->create()->pluck('id')->toArray();
        }

        if (empty($suppliers)) {
            $suppliers = User::factory()->count(3)->create(['role' => 'supplier'])->pluck('id')->toArray();
        }

        // Список автомобильных запчастей
        $autoParts = [
            ['name' => 'Тормозные колодки', 'article' => 'BRK-'.rand(1000, 9999)],
            ['name' => 'Амортизаторы передние', 'article' => 'SHK-'.rand(1000, 9999)],
            ['name' => 'Свечи зажигания', 'article' => 'SPK-'.rand(1000, 9999)],
            ['name' => 'Воздушный фильтр', 'article' => 'AIR-'.rand(1000, 9999)],
            ['name' => 'Масляный фильтр', 'article' => 'OIL-'.rand(1000, 9999)],
            ['name' => 'Ремень ГРМ', 'article' => 'TMB-'.rand(1000, 9999)],
            ['name' => 'Генератор', 'article' => 'GEN-'.rand(1000, 9999)],
            ['name' => 'Стартер', 'article' => 'STR-'.rand(1000, 9999)],
            ['name' => 'Аккумулятор 60Ah', 'article' => 'BAT-'.rand(1000, 9999)],
            ['name' => 'Фара передняя левая', 'article' => 'LHP-'.rand(1000, 9999)],
            ['name' => 'Стекло лобовое', 'article' => 'WSH-'.rand(1000, 9999)],
            ['name' => 'Диски колесные 16"', 'article' => 'WHL-'.rand(1000, 9999)],
            ['name' => 'Топливный насос', 'article' => 'FUP-'.rand(1000, 9999)],
            ['name' => 'Термостат', 'article' => 'THS-'.rand(1000, 9999)],
            ['name' => 'Ступичный подшипник', 'article' => 'WBR-'.rand(1000, 9999)],
        ];

        foreach ($autoParts as $part) {
            $price = $faker->numberBetween(500, 20000);
            $oldPrice = $faker->boolean(30) ? $price * 1.2 : null;
            
            Product::create([
                'brand_id' => $faker->randomElement($brands),
                'article' => $part['article'],
                'name' => $part['name'],
                'quantity' => $faker->numberBetween(1, 50),
                'manufacturer_id' => $faker->randomElement($manufacturers),
                'city_id' => $faker->randomElement($cities),
                'price' => $price,
                'price_updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'supplier_id' => $faker->randomElement($suppliers),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
        
        // $faker = Faker::create('ru_RU');
        
        // // Сначала создаем необходимых пользователей
        // $buyers = User::factory()->count(10)->create(['role' => 'buyer', 'company' => "test"]);
        // $sellers = User::factory()->count(10)->create(['role' => 'seller', 'company' => "test"]);

        // $autoParts = [
        //     'Тормозные колодки',
        //     'Амортизаторы',
        //     'Свечи зажигания',
        //     'Воздушный фильтр',
        //     'Масляный фильтр',
        //     'Ремень ГРМ',
        //     'Генератор',
        //     'Стартер',
        //     'Аккумулятор',
        //     'Фары',
        //     'Стекло лобовое',
        //     'Диски колесные'
        // ];

        // for ($i = 0; $i < 12; $i++) {
        //     $request = CustomerRequest::create([
        //         'subject' => 'Нужны ' . $autoParts[$i],
        //         'city_id' => $faker->numberBetween(1, 10),
        //         'comment' => $faker->realText(200),
        //         'file_path' => $i % 3 === 0 ? 'requests/file' . ($i+1) . '.pdf' : null,
        //         'user_id' => $buyers->random()->id, // Берем случайного покупателя
        //     ]);

        //     SellerResponse::create([
        //         'customer_request_id' => $request->id,
        //         'user_id' => $sellers->random()->id, // Берем случайного продавца
        //         'response_text' => $faker->realText(150),
        //         'file_path' => $i % 4 === 0 ? 'responses/offer' . ($i+1) . '.pdf' : null,
        //         'responded_items' => json_encode([
        //             'item' => $autoParts[$i],
        //             'brand' => $faker->randomElement(['Bosch', 'Mann', 'Sachs', 'Brembo', 'KYB']),
        //             'price' => $faker->numberBetween(1000, 10000),
        //             'quantity' => $faker->numberBetween(1, 4),
        //         ]),
        //         'status' => 'completed',
        //     ]);
        // }

        // ContactSetting::create([
        //     'company_name' => 'ТехноПартнер',
        //     'address' => 'г. Москва, ул. Промышленная, д. 42, офис 305',
        //     'map_link' => 'https://yandex.ru/maps/org/12345',
        //     'phone_primary' => '+7 (495) 123-45-67',
        //     'phone_secondary' => '+7 (800) 123-45-67',
        //     'email_primary' => 'info@tehnopartner.ru',
        //     'email_secondary' => 'sales@tehnopartner.ru',
        //     'work_hours' => 'Пн-Пт: 9:00-18:00, Сб-Вс: выходной',
        //     'social_links' => json_encode([
        //         'vk' => 'https://vk.com/tehnopartner',
        //         'telegram' => 'https://t.me/tehnopartner',
        //         'whatsapp' => 'https://wa.me/74951234567'
        //     ]),
        //     'additional_info' => 'Реквизиты: ИНН 1234567890, ОГРН 1234567890123'
        // ]);
    }
}
