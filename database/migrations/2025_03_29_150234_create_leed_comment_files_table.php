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
        Schema::create('leed_comment_files', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('leed_record_comment_id');
            $table->unsignedBigInteger('user_id');
            $table->string('file_name', 255);
            $table->string('path', 255);
            $table->string('mini', 255)->nullable()->comment('для ссылки на превью');

            // Foreign key constraints
            $table->foreign('leed_record_comment_id')
                ->references('id')
                ->on('leed_record_comments')
//                ->onDelete('cascade')
            ;

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
//                ->onDelete('cascade')
            ;

            $table->softDeletes(); // Adds `deleted_at` column
            $table->timestamps(); // Adds `created_at` and `updated_at` columns

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_comment_files');
    }
};
