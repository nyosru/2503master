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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_payment_type_id')->nullable();
            $table->unsignedBigInteger('order_product_type_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->string('name', 100);
            $table->text('order_form_data')->nullable();
            $table->longText('form_data')->nullable();
            $table->unsignedInteger('form_id')->nullable();
            $table->enum('form_type', ['fields', 'blocks'])->default('fields');
            $table->unsignedInteger('manager_id')->nullable();
            $table->enum('in_archive', ['yes', 'no'])->default('no');
            $table->timestamp('add_ts')->useCurrent();
            $table->unsignedInteger('last_log_id')->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('price_without_decor')->nullable();
            $table->unsignedInteger('price_stone_countertop')->nullable();
            $table->string('ready_dates', 1000)->default('[]');
            $table->unsignedBigInteger('last_roles_log_id')->nullable();
            $table->unsignedInteger('last_change_staff_id')->nullable();
            $table->timestamp('last_change_ts')->useCurrent();
            $table->unsignedBigInteger('contract_id')->default(1);
            $table->enum('urgently', ['yes', 'no'])->default('no');
            $table->integer('group_id')->default(1);
            $table->unsignedInteger('brigade_id')->nullable();
            $table->enum('types', ['kuhna', 'shkaf', 'vannaya', 'garderob', 'complex', 'other']);
            $table->string('type_payments', 100);
            $table->integer('type_payments_month')->nullable();
            $table->enum('forms_payment', ['nal', 'rs']);
            $table->integer('discount')->nullable();
            $table->string('adres', 255)->nullable();
            $table->text('labels')->nullable();
            $table->integer('design')->nullable();
            $table->enum('success_payment', ['yes', 'no'])->default('no');
            $table->text('comment_akcia')->nullable();
            $table->integer('production_time')->nullable();
            $table->integer('guarantee_period')->nullable();
            $table->longText('order_schedule')->nullable();
            $table->string('order_tfmf', 100)->nullable();
            $table->integer('summa_work')->default(0);
            $table->integer('summa_install')->default(0);
            $table->integer('summa_dop')->default(0)->comment('доп заказ сумма мебели');
            $table->integer('summa_dop2')->default(0)->comment('доп заказ стоимость камня');
            $table->enum('payment_dop', ['null', 'nal', 'rs', 'perevod'])->default('null');
            $table->text('comment_dop')->nullable();
            $table->integer('virtual_order_id')->nullable();
            $table->integer('virtual_service_id')->nullable();
            $table->enum('service', ['A', 'no'])->default('no');
            $table->text('usluga')->nullable();
            $table->integer('summa_mebel')->default(0);
            $table->integer('summa_build')->default(0);
            $table->integer('summa_zamer')->default(0);
            $table->integer('summa_dost')->default(0);
            $table->integer('summa_gruz')->default(0);
            $table->integer('summa_tech')->default(0);
            $table->integer('summa_manager')->default(0);
            $table->unsignedBigInteger('leed_id')->nullable();
            $table->date('montag_date')->nullable();
            $table->string('montag_date_comment', 255)->nullable();
            $table->string('dogovor_number', 255)->nullable();

            // Индексы
            $table->index('client_id');
            $table->index('form_id');
            $table->index('manager_id');
            $table->index('last_log_id');
            $table->index('add_ts');
            $table->index('last_roles_log_id');
            $table->index('contract_id');
            $table->index('last_change_staff_id');
            $table->index('brigade_id');
            $table->index(['virtual_order_id', 'virtual_service_id']);
            $table->index('leed_id');
            $table->index('order_payment_type_id');
            $table->index('order_product_type_id');
            $table->fullText('name');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
