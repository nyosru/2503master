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
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leed_record_id')->constrained('leed_records')
                ->onDelete('cascade')
            ;
            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade')
            ;
            $table->string('file_name');
            $table->string('path');

            $table->string('name')->nullable();
            $table->string('mini')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_uploads');
    }
};
