<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('tipo_documento_persona_id');
            $table->string('numero_documento')->unique();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('estado');
            $table->rememberToken();
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
