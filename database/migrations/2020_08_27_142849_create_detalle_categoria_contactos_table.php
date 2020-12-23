<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCategoriaContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_categoria_contactos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('contacto_id');
            $table->integer('subcategoria_id');
            $table->timestamps();

            $table->foreign('contacto_id')->references('id')->on('contactos')->onDelete('cascade');
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_categoria_contactos');
    }
}
