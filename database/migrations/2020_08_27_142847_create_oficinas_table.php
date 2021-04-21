<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOficinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas', function (Blueprint $table) {

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->string('direccion', 100);
            $table->string('complemento_direccion')->nullable();
            $table->integer('tipo_oficina_id')->unsigned();
            $table->integer('pais_id')->unsigned();
            $table->bigInteger('departamento_estado_id')->unsigned();
            $table->bigInteger('ciudad_id')->unsigned();
            $table->string('telefono_1', 20)->nullable();
            $table->string('telefono_2', 20)->nullable();
            $table->string('pbx', 20)->nullable();
            $table->boolean('estado');
            $table->timestamps();
            $table->integer('usuario_creacion')->unsigned();
            $table->integer('usuario_actualizacion')->unsigned();

            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('tipo_oficina_id')->references('id')->on('tipo_oficinas');
            $table->foreign('pais_id')->references('id')->on('pais');
            $table->foreign('departamento_estado_id')->references('id')->on('departamento_estados');
            $table->foreign('ciudad_id')->references('id')->on('ciudads');
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
        Schema::dropIfExists('oficinas');
    }
}
