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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // заголовок
            $table->text('excerpt')->nullable(); // краткий текст
            $table->longText('content'); // нормальный текст
            $table->string('image')->nullable(); // картинка
            $table->foreignId('author_user_id')->constrained('users')->onDelete('cascade'); // автор
            $table->boolean('is_published')->default(false); // опубликовано ли
            $table->timestamp('published_at')->nullable(); // дата публикации
            $table->timestamps();
            $table->softDeletes(); // мягкое удаление

            // Индексы для оптимизации
            $table->index('is_published');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
