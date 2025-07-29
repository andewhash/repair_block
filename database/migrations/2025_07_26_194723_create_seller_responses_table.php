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
        Schema::create('seller_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_request_id')->constrained();
            $table->foreignId('user_id')->constrained()->comment('Кто ответил (продавец)');
            $table->text('response_text')->nullable(); // Текст ответа
            $table->string('file_path')->nullable(); // Прикрепленный файл
            $table->json('responded_items')->nullable()->comment('JSON с ID позиций на которые ответили');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_responses');
    }
};
