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
        Schema::table('boards', function (Blueprint $table) {
            // Добавляем поле view с типом string и значением по умолчанию 'kanban'
//            $table->string('view')->default('kanban')->after('domain_id');

            // Если хотите ограничить только двумя значениями, можно использовать enum (Laravel 12 поддерживает enum natively):
             $table->enum('view', ['kanban', 'table'])->default('kanban')->after('domain_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->dropColumn('view');
        });
    }
};
