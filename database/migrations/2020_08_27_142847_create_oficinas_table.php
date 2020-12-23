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

            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->string('direccion');
            $table->string('complemento_direccion')->nullable();
            $table->integer('tipo_oficina_id');
            $table->integer('pais_id');
            $table->bigInteger('departamento_estado_id');
            $table->bigInteger('ciudad_id');
            $table->string('telefono_1')->nullable();
            $table->string('telefono_2')->nullable();
            $table->string('pbx')->nullable();
            $table->boolean('estado');
            $table->timestamps();
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');

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
