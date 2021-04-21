<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->text('nombre');
            $table->text('path');
            $table->string('tipo');
            $table->integer('usuario_creacion')->unsigned();
            $table->timestamps();

            $table->foreign('usuario_creacion')->references('id')->on('users');
            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivo');
    }
}
