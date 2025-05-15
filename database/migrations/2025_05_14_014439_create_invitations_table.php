<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->nullable()
                ->comment('в какой доске')
                ->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('phone')
                ->comment('номер телефона приглашаемого');
            $table->foreignId('role_id')->nullable()
                ->comment('какая роль предлагается')
                ->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()
                ->comment('кто создал приглашение')
                ->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
