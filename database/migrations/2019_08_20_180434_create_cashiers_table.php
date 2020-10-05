<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cedula', 100)->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('direccion');
            $table->integer('atendidos')->nullable();
            $table->integer('puesto')->nullable();
            $table->bigInteger('id_business')->unsigned();
            $table->foreign('id_business')->references('id')->on('users');
            $table->bigInteger('id_subsidiary')->unsigned();
            $table->foreign('id_subsidiary')->references('id')->on('subsidiaries');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashiers');
    }
}
