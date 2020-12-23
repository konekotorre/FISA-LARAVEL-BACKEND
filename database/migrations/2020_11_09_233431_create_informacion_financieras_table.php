<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionFinancierasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_financieras', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('organizacion_id');
            $table->bigInteger('ingresos_anuales')->nullable();
            $table->bigInteger('egresos_anuales')->nullable();
            $table->bigInteger('ingresos_operacionales')->nullable();
            $table->bigInteger('egresos_operacionales')->nullable();
            $table->bigInteger('ingresos_no_operacionales')->nullable();
            $table->bigInteger('egresos_no_operacionales')->nullable();
            $table->bigInteger('ventas_anuales')->nullable();
            $table->bigInteger('total_activos')->nullable();
            $table->bigInteger('total_pasivos')->nullable();
            $table->bigInteger('patrimonio_total')->nullable();
            $table->integer('regimen_id')->nullable();
            $table->year('temporada_declaracion')->nullable();
            $table->integer('clasificacion_id')->nullable();
            $table->year('temporada_cuota')->nullable();
            $table->double('cuota_anual')->nullable();
            $table->double('cuota_real_anual')->nullable();
            $table->double('cuota_real_afiliacion')->nullable();
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('regimen_id')->references('id')->on('regimens');
            $table->foreign('organizacion_id')->references('id')->on('organizacions')->onDelete('cascade');
            $table->foreign('clasificacion_id')->references('id')->on('clasificacions');
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
        Schema::dropIfExists('informacion_financieras');
    }
}
