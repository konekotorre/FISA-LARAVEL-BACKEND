<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->bigInteger('oficina_id')->nullable();
            $table->bigInteger('contacto_id');
            $table->date('fecha_programada');
            $table->date('fecha_ejecucion')->nullable();
            $table->text('titulo');
            $table->text('razon')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('resultado')->nullable();
            $table->integer('usuario_asignado');
            $table->boolean('estado');
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('contacto_id')->references('id')->on('contactos');
            $table->foreign('oficina_id')->references('id')->on('oficinas');
            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('usuario_creacion')->references('id')->on('users');
            $table->foreign('usuario_actualizacion')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
