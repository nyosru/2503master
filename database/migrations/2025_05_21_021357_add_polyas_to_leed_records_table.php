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
        Schema::table('leed_records', function (Blueprint $table) {
            // Поля integer, nullable
            $table->integer('number1')->nullable();
            $table->integer('number2')->nullable();
            $table->integer('number3')->nullable();
            $table->integer('number4')->nullable();
            $table->integer('number5')->nullable();
            $table->integer('number6')->nullable();

            // Поля date, nullable
            $table->dateTime('dt1')->nullable();
            $table->dateTime('dt2')->nullable();
            $table->dateTime('dt3')->nullable();

            // Поля date, nullable
            $table->date('date1')->nullable();
            $table->date('date2')->nullable();
            $table->date('date3')->nullable();
            $table->date('date4')->nullable();

            // Поля string(255), nullable
            $table->string('string1', 255)->nullable();
            $table->string('string2', 255)->nullable();
            $table->string('string3', 255)->nullable();
            $table->string('string4', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leed_records', function (Blueprint $table) {
            $table->dropColumn([
                'number1', 'number2', 'number3', 'number4', 'number5', 'number6',
                'date1', 'date2', 'date3', 'date4',
                'dt1', 'dt2', 'dt3',
                'string1', 'string2', 'string3', 'string4',
            ]);
        });
    }
};
