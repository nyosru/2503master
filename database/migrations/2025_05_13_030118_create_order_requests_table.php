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
        Schema::create('order_requests', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable();
            $table->string('var', 255);
            $table->string('description')->nullable();

            $table->boolean('number')->default(false);
            $table->boolean('date')->default(false);
            $table->boolean('text')->default(false);

            $table->boolean('string')->default(false);
            $table->boolean('nullable')->default(false);
            $table->string('rules', 255)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_requests');
    }
};
