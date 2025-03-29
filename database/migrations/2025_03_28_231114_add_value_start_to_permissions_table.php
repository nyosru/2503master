<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public $a = [
        'р.Лиды / добавить столбцы' => 32,
//        '' => 30,
//        '' => 30,
//        '' => 30,
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach( $this->a as $k => $v ) {
            DB::table('permissions')->insert([
                'name' => $k,
                'guard_name' => 'web',
                'sort' => $v,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach( $this->a as $k => $v ) {
            DB::table('permissions')->where('name', $k )->delete();
        }
    }
};
