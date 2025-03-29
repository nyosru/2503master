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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamp('add_ts')->useCurrent();

            // ФИО
            $table->string('name_i', 250);
            $table->string('name_f', 250)->nullable();
            $table->string('name_o', 250)->nullable();

            // Контакты
            $table->string('phone', 50)->default('');
            $table->text('extra_contacts')->nullable();

            // Адрес
            $table->string('address', 250)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('street', 250)->nullable();
            $table->string('building', 250)->nullable();
            $table->string('building_part', 250)->nullable();
            $table->string('cvartira', 10)->nullable();
            $table->string('floor', 250)->nullable();
            $table->string('lift', 250)->nullable();

            // Дополнительная информация
            $table->string('email', 250)->nullable();
            $table->text('comment')->nullable();

            // Юридические данные
            $table->enum('physical_person', ['yes', 'no'])->nullable();
            $table->enum('status', ['recom', 'pos', 'design'])->nullable();
            $table->enum('forma', ['ip', 'ooo'])->nullable();

            // Паспортные данные
            $table->string('avatar', 255)->nullable();
            $table->text('passport')->nullable();
            $table->unsignedInteger('seria_passport')->nullable();
            $table->unsignedInteger('nomer_passport')->nullable();
            $table->date('date_passport')->nullable();
            $table->text('cod_passport')->nullable();

            // Юридическое лицо
            $table->text('ur_passport')->nullable();
            $table->string('ur_name', 255)->nullable();
            $table->string('name_company', 255)->nullable();

            // Статусы
            $table->enum('active', ['yes', 'no'])->default('yes');

            // Системные поля
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
