<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento_organizacions')->insert([
            'nombre' => 'NIT',
            'descripcion' => 'Número de Identificación Tributaria',
        ]);

        DB::table('tipo_documento_organizacions')->insert([
            'nombre' => 'CC',
            'descripcion' => 'cédula de Ciudadanía',
        ]);

        DB::table('tipo_documento_organizacions')->insert([
            'nombre' => 'CE',
            'descripcion' => 'Cédula de Extranjería',
        ]);
    }
}
