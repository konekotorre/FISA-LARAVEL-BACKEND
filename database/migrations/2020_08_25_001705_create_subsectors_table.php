<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsectors', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->integer('sector_id');
            $table->timestamps();

            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subsectors');
    }
}
