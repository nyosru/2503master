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
//        Schema::table('orders', function (Blueprint $table) {
//            // Удаляем полнотекстовый индекс (если существует)
//            $table->dropIndexIfExists('orders_name_fulltext');
//
//            // Добавляем обычный индекс
//            $table->index('name', 'orders_name_fulltext');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('orders', function (Blueprint $table) {
//            // Удаляем обычный индекс
//            $table->dropIndexIfExists('orders_name_fulltext');
//
//            // Восстанавливаем полнотекстовый индекс
////            $table->fullText('name', 'orders_name_fulltext');
//        });
    }
};
