<?php

namespace App\Imports;

use App\Models\User;
use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection, WithHeadingRow
{
    private $successCount = 0;
    private $skippedCount = 0;
    private $errors = [];
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Проверка обязательных полей
            if (empty($row['email']) || empty($row['name']) || empty($row['company']) || empty($row['role'])) {
                $this->skippedCount++;
                $this->errors[] = "Строка " . ($row->getIndex() + 2) . ": Пропущено - отсутствуют обязательные поля";
                continue;
            }
            
            // Проверка уникальности email
            if (User::where('email', $row['email'])->exists()) {
                $this->skippedCount++;
                $this->errors[] = "Строка " . ($row->getIndex() + 2) . ": Пропущено - пользователь с email " . $row['email'] . " уже существует";
                continue;
            }
            
            try {
                // Обработка города
                $cityId = null;
                if (!empty($row['city'])) {
                    $city = City::firstOrCreate(['name' => $row['city']]);
                    $cityId = $city->id;
                }
                
                // Создание пользователя
                User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'company' => $row['company'],
                    'role' => $row['role'],
                    'inn' => $row['inn'] ?? null,
                    'phone' => $row['phone'] ?? null,
                    'city_id' => $cityId,
                    'about' => $row['about'] ?? null,
                    'password' => Hash::make($row['password'] ?? 'password'), // Генерируем пароль по умолчанию
                ]);
                
                $this->successCount++;
                
            } catch (\Exception $e) {
                $this->skippedCount++;
                $this->errors[] = "Строка " . ($row->getIndex() + 2) . ": Ошибка - " . $e->getMessage();
            }
        }
    }
    
    public function getSuccessCount()
    {
        return $this->successCount;
    }
    
    public function getSkippedCount()
    {
        return $this->skippedCount;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}