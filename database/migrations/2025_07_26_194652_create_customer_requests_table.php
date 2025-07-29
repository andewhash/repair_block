<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_requests', function (Blueprint $table) {
            $table->id();
            $table->string('subject'); // Тема (обязательное)
            $table->foreignId('city_id')->constrained('cities'); // Город (обязательное)
            $table->text('comment')->nullable(); // Комментарий
            $table->string('file_path')->nullable(); // Путь к файлу/фото
            $table->foreignId('user_id')->constrained()->comment('Кто создал запрос');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_requests');
    }
};
