<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->integer('tipo_documento_persona_id')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('sexo_id')->nullable();
            $table->string('celular')->nullable();
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('tipo_documento_persona_id')->references('id')->on('tipo_documento_personas');
            $table->foreign('sexo_id')->references('id')->on('sexos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
