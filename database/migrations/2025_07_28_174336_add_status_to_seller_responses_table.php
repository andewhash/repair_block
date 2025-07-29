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
        Schema::table('seller_responses', function (Blueprint $table) {
            $table->string('status')
                  ->default('new')
                  ->after('responded_items')
                  ->comment('Статус отклика: new, completed, canceled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_responses', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
