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
