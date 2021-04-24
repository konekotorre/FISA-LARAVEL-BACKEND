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

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->bigInteger('oficina_id')->nullable()->unsigned();
            $table->integer('persona_id')->nullable()->unsigned();
            $table->boolean('representante')->nullable();
            $table->string('cargo', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('email_2', 200)->nullable();
            $table->boolean('control_informacion')->nullable();
            $table->boolean('envio_informacion')->nullable();
            $table->longText('observaciones')->nullable();
            $table->boolean('estado');
            $table->integer('usuario_creacion')->unsigned();
            $table->integer('usuario_actualizacion')->unsigned();
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
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
