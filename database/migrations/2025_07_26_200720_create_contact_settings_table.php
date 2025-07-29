<?php
// database/migrations/YYYY_MM_DD_create_contact_settings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable()->comment('Название компании');
            $table->string('address')->nullable()->comment('Полный адрес');
            $table->string('map_link')->nullable()->comment('Ссылка на карты (Google/Yandex)');
            $table->string('phone_primary')->nullable()->comment('Основной телефон');
            $table->string('phone_secondary')->nullable()->comment('Дополнительный телефон');
            $table->string('email_primary')->nullable()->comment('Основной email');
            $table->string('email_secondary')->nullable()->comment('Дополнительный email');
            $table->string('work_hours')->nullable()->comment('Часы работы (например: Пн-Пт 9:00-18:00)');
            $table->text('social_links')->nullable()->comment('JSON соцсети: {vk: "", telegram: ""}');
            $table->text('additional_info')->nullable()->comment('Дополнительная информация');
            $table->string('logo_path')->nullable()->comment('Путь к логотипу');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_settings');
    }
};