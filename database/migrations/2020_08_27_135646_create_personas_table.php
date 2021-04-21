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
            
            $table->bigIncrements('id')->unsigned();
            $table->integer('tipo_documento_persona_id')->nullable()->unsigned();
            $table->string('numero_documento', 20)->nullable();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->integer('sexo_id')->nullable()->unsigned();
            $table->string('celular', 20)->nullable();
            $table->integer('usuario_creacion')->unsigned();
            $table->integer('usuario_actualizacion')->unsigned();
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
