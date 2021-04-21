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

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('visita_id')->unsigned();
            $table->text('titulo');
            $table->text('descripcion')->nullable();
            $table->text('resultado')->nullable();
            $table->integer('estado_id')->unsigned();
            $table->integer('usuario_creacion')->unsigned();
            $table->integer('usuario_actualizacion')->unsigned();
            $table->timestamps();

            $table->foreign('visita_id')->references('id')->on('visitas')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estado_tareas');
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
