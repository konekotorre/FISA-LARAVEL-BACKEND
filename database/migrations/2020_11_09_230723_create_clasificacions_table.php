<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificacions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->double('cuota_anual');
            $table->year('temporada_cuota');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clasificacions');
    }
}
