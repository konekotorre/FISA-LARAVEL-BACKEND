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

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->bigInteger('oficina_id')->nullable()->unsigned();
            $table->bigInteger('contacto_id')->nullable()->unsigned();
            $table->date('fecha_programada');
            $table->date('fecha_ejecucion')->nullable();
            $table->text('titulo');
            $table->text('razon')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('resultado')->nullable();
            $table->integer('usuario_asignado')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('usuario_creacion')->unsigned();
            $table->integer('usuario_actualizacion')->unsigned();
            $table->timestamps();

            $table->foreign('contacto_id')->references('id')->on('contactos');
            $table->foreign('oficina_id')->references('id')->on('oficinas');
            $table->foreign('estado_id')->references('id')->on('estado_visitas');
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
