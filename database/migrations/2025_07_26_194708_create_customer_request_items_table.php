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
        Schema::create('customer_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_request_id')->constrained()->cascadeOnDelete();
            $table->integer('item_number')->comment('Порядковый номер');
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('article'); // Артикул
            $table->string('name'); // Наименование
            $table->integer('quantity'); // Количество
            $table->string('quality_type')->comment('Оригинал/Аналог/OEM/REMAN');
            $table->decimal('price', 10, 2)->nullable(); // Цена
            $table->integer('delivery_days')->nullable()->comment('Срок поставки в кал.днях');
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
            $table->text('comment')->nullable(); // Комментарий
            $table->string('file_path')->nullable(); // Файл
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_request_items');
    }
};
