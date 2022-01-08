<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoVisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motivo_visita')->insert([
            'nombre' => 'PAUTAS'
        ]);

        DB::table('motivo_visita')->insert([
            'nombre' => 'SEGUIMIENTO'
        ]);

        DB::table('motivo_visita')->insert([
            'nombre' => 'COMERCIAL'
        ]);

        DB::table('motivo_visita')->insert([
            'nombre' => 'COBRO'
        ]);

        DB::table('motivo_visita')->insert([
            'nombre' => 'POTENCIAL'
        ]);
    }
}
