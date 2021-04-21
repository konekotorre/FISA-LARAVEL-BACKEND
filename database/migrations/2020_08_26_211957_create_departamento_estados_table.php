<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentoEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento_estados', function (Blueprint $table) {

            $table->bigIncrements('id')->unsigned();
            $table->string('nombre', 100)->unique();
            $table->integer('pais_id');
            $table->timestamps();

            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamento_estados');
    }
}
