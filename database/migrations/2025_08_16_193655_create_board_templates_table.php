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
        Schema::create('board_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // название шаблона доски
            $table->boolean('status')->default(true);       // статус
            $table->integer('price')->nullable()->default(0);  // цена, может быть нулём
            $table->integer('sort')->default(50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_templates');
    }
};
