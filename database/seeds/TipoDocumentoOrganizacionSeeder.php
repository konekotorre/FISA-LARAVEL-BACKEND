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
            'id' => '1',
            'nombre' => 'NIT',
            'descripcion' => 'Número de Identificación Tributaria',
        ]);

        DB::table('tipo_documento_organizacions')->insert([
            'id' => '2',
            'nombre' => 'CC',
            'descripcion' => 'cédula de Ciudadanía',
        ]);

        DB::table('tipo_documento_organizacions')->insert([
            'id' => '3',
            'nombre' => 'CE',
            'descripcion' => 'Cédula de Extranjería',
        ]);
    }
}
