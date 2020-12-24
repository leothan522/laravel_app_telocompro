<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('telefono');
            $table->text('direccion_1');
            $table->text('direccion_2')->nullable();
            $table->text('localidad');
            $table->string('codigo_postal')->nullable();
            $table->bigInteger('estados_id')->unsigned()->nullable();
            $table->bigInteger('municipios_id')->unsigned()->nullable();
            $table->bigInteger('parroquias_id')->unsigned()->nullable();
            $table->bigInteger('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('estados_id')->references('id')->on('estados')->nullOnDelete();
            $table->foreign('municipios_id')->references('id')->on('municipios')->nullOnDelete();
            $table->foreign('parroquias_id')->references('id')->on('parroquias')->nullOnDelete();
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
        Schema::dropIfExists('clientes');
    }
}
