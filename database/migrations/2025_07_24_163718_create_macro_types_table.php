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
        Schema::create('macro_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // название типа макроса, обязательное поле
            $table->boolean('status')->default(true); // статус, по умолчанию true
            $table->timestamps();
            $table->softDeletes();                // если нужно мягкое удаление (по желанию)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('macro_types');
    }
};
