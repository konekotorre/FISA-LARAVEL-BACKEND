<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_organizacions')->insert([
            'nombre' => 'PRIVADA'
        ]);

        DB::table('tipo_organizacions')->insert([
            'nombre' => 'PÚBLICA'
        ]);

        DB::table('tipo_organizacions')->insert([
            'nombre' => 'MIXTA'
        ]);
    }
}
