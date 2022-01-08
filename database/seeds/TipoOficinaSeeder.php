<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoOficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('tipo_oficinas')->insert([
        //     'nombre' => 'Principal',
        // ]);

        // DB::table('tipo_oficinas')->insert([
        //     'nombre' => 'Sede',
        // ]);

        DB::table('motivo_tareas')->insert([
            'nombre' => 'SEGUIMIENTO'
        ]);

        DB::table('motivo_tareas')->insert([
            'nombre' => 'SOLICITUDES'
        ]);

        DB::table('motivo_tareas')->insert([
            'nombre' => 'COBRO'
        ]);

        DB::table('motivo_visitas')->insert([
            'nombre' => 'PAUTAS'
        ]);

        DB::table('motivo_visitas')->insert([
            'nombre' => 'SEGUIMIENTO'
        ]);

        DB::table('motivo_visitas')->insert([
            'nombre' => 'COMERCIAL'
        ]);

        DB::table('motivo_visitas')->insert([
            'nombre' => 'COBRO'
        ]);

        DB::table('motivo_visitas')->insert([
            'nombre' => 'POTENCIAL'
        ]);

        }
}
