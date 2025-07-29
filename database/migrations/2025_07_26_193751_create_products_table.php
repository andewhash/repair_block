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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('article'); // Артикул
            $table->string('name'); // Наименование
            $table->integer('quantity'); // Количество
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
            $table->foreignId('city_id')->constrained('cities');
            $table->decimal('price', 10, 2)->nullable(); // Цена (видна только зарегистрированным)
            $table->date('price_updated_at'); // Дата обновления цены
            $table->foreignId('supplier_id')->constrained('users'); // Поставщик (user_id)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
