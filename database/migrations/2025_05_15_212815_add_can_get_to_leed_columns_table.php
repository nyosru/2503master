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
        Schema::table('leed_columns', function (Blueprint $table) {
            $table->boolean('can_get')
                ->default(false)
                ->comment('польз может брать к себе лида');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leed_columns', function (Blueprint $table) {
            $table->dropColumn('can_get');
        });
    }
};
