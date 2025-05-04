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
        Schema::create('leed_notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('leed_id')->constrained('leed_records')->cascadeOnDelete();

            $table->text('message');

            // Типы оповещений: одноразовое, еженедельное, ежемесячное, ежегодное
            $table->dateTime('once_at')->nullable();

            // Для еженедельного: 0 (воскресенье) - 6 (суббота)
            $table->tinyInteger('weekly_day')->nullable();
            $table->time('weekly_time')->nullable();

            // Для ежемесячного: 1-31
            $table->tinyInteger('monthly_day')->nullable();
            $table->time('monthly_time')->nullable();

            // Для ежегодного: день и месяц
            $table->tinyInteger('yearly_day')->nullable();
            $table->tinyInteger('yearly_month')->nullable();
            $table->time('yearly_time')->nullable();

            // Кому отправить
            $table->unsignedBigInteger('phone_to_send')->nullable();

//            $table->unsignedBigInteger('telegram_id')->nullable();
//            $table->foreign('telegram_id')->references('id')->on('telegram_users')->nullOnDelete();

            $table->foreignId('user_id')->nullable()->constrained()
//                ->nullOnDelete()
            ;

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_notifications');
    }
};
