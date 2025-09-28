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
        // мягкое удаление записи
        DB::table('order_requests') ->where('pole', 'price') ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // восстановление softdeleted записи
        DB::table('order_requests') ->where('pole', 'price') ->update(['deleted_at' => null]);
    }
};
