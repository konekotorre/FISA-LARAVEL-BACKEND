<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->integer('tipo_documento_persona_id')->nullable();
            $table->bigInteger('oficina_id')->nullable();
            $table->bigInteger('numero_documento')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->boolean('representante')->nullable();
            $table->string('sexo')->nullable();
            $table->string('cargo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('estado');
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('tipo_documento_persona_id')->references('id')->on('tipo_documento_personas');
            $table->foreign('oficina_id')->references('id')->on('oficinas')->onDelete('cascade');
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
        Schema::dropIfExists('contactos');
    }
}
