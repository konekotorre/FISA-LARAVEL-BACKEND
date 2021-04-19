<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizacions', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->longText('nombre');
            $table->integer('tipo_documento_organizacion_id');
            $table->string('numero_documento');
            $table->longText('razon_social')->nullable();
            $table->integer('categoria_id');
            $table->integer('clase_id')->nullable();
            $table->integer('pais_id')->nullable();
            $table->integer('sector_id')->nullable();
            $table->integer('subsector_id')->nullable();
            $table->integer('tipo_organizacion_id')->nullable();
            $table->string('pagina_web')->nullable();
            $table->longText('observaciones')->nullable();
            $table->date('fecha_afiliacion')->nullable();
            $table->integer('empleados_directos')->nullable();
            $table->integer('empleados_indirectos')->nullable();
            $table->longText('motivo_afiliacion')->nullable();
            $table->date('fecha_desafiliacion')->nullable();
            $table->longText('motivo_desafiliacion')->nullable();
            $table->boolean('estado');
            $table->integer('usuario_creacion');
            $table->integer('usuario_actualizacion');
            $table->timestamps();

            $table->foreign('tipo_documento_organizacion_id')->references('id')->on('tipo_documento_organizacions');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('pais_id')->references('id')->on('pais');
            $table->foreign('tipo_organizacion_id')->references('id')->on('tipo_organizacions');
            $table->foreign('clase_id')->references('id')->on('clases');
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreign('subsector_id')->references('id')->on('subsectors');
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
        Schema::dropIfExists('organizacions');
    }
}
