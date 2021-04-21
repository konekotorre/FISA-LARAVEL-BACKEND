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

            $table->increments('id')->unsigned();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->integer('tipo_documento_persona_id')->unsigned();
            $table->string('numero_documento', 14)->unique();
            $table->string('usuario', 50)->unique();
            $table->string('password');
            $table->string('email', 50)->unique();
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
