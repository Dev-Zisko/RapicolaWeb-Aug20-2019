<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsidiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidiaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rif', 100);
            $table->string('nombre');
            $table->string('telefono', 100)->unique();
            $table->string('direccion');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('logo');
            $table->bigInteger('id_business')->unsigned();
            $table->foreign('id_business')->references('id')->on('users');
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
        Schema::dropIfExists('subsidiaries');
    }
}
