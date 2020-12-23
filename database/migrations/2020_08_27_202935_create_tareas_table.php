<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('visita_id');
            $table->text('titulo');
            $table->text('descripcion');
            $table->text('resultado')->nullable();
            $table->integer('usuario_asignado');
            $table->boolean('estado');
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('visita_id')->references('id')->on('visitas')->onDelete('cascade');
            $table->foreign('usuario_asignado')->references('id')->on('users');
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
        Schema::dropIfExists('tareas');
    }
}
