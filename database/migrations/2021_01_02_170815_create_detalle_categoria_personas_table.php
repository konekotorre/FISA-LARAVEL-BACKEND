<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCategoriaPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('detalle_categoria_personas', function (Blueprint $table) {

        //     $table->bigIncrements('id')->unsigned();
        //     $table->bigInteger('persona_id')->unsigned();
        //     $table->integer('subcategoria_id')->unsigned();
        //     $table->timestamps();

        //     $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        //     $table->foreign('subcategoria_id')->references('id')->on('subcategorias');
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_categoria_personas');
    }
}
