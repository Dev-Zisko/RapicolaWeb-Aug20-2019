<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cedula', 100)->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono', 100)->unique()->nullable();
            $table->string('email', 100)->unique();
            $table->string('direccion')->nullable();
            $table->string('status')->nullable();
            $table->integer('puesto')->nullable();
            $table->bigInteger('id_queue')->unsigned()->nullable();
            $table->foreign('id_queue')->references('id')->on('queues');
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
        Schema::dropIfExists('customers');
    }
}
