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
        Schema::create('client_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('как зовут от кого клиент');
            $table->string('phone')->nullable()->comment('телефон от кого пришёл');
            $table->string('title')->comment('название от кого пришёл');
            $table->softDeletes(); // Добавляет столбец `deleted_at` timestamp NULL DEFAULT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_suppliers');
    }
};
