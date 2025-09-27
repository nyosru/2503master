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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

//            $table->foreignId('leed_id')->constrained('leed_records')->cascadeOnDelete();
//            $table->foreign('board_id')->references('id')->on('boards')->onDelete('set null');
            $table->foreign('board_id')->references('id')->on('boards')->cascadeOnDelete();

            $table->string('name'); // Название документа

            $table->text('url_template'); // Шаблон URL с плейсхолдерами, например '/documents/contract/{{leed_id}}'


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
