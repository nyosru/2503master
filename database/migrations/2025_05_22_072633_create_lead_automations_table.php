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
        Schema::create('lead_automations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('board_id')->nullable();
            $table->unsignedBigInteger('source_column_id')->nullable();
            $table->unsignedBigInteger('target_column_id')->nullable();
            $table->string('action')->nullable();
            $table->string('string1')->nullable();
            $table->string('string2')->nullable();
            $table->unsignedInteger('integer1')->nullable();
            $table->unsignedInteger('integer2')->nullable();
            $table->unsignedInteger('delay_days')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_automations');
    }
};
