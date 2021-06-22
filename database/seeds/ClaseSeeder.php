<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('clases')->insert([
            'nombre' => 'SOCIEDAD PRIVADA NACIONAL',
        ]);

        DB::table('clases')->insert([
            'nombre' => 'ENTIDAD PÚBLICA EXTRANJERA',
        ]);

        DB::table('clases')->insert([
            'nombre' => 'ENTIDAD SIN ÁNIMO DE LUCRO',
        ]);

        DB::table('clases')->insert([
            'nombre' => 'SOCIEDAD ANONIMA',
        ]);
        
        DB::table('clases')->insert([
            'nombre' => 'SOCIEDADES POR ACCIONES SIMPLIFICADAS SA',
        ]);

    }
}
