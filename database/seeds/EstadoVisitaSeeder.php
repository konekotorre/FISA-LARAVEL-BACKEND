<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoVisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_visitas')->insert([
            'nombre' => 'AGENDADA'
        ]);

        DB::table('estado_visitas')->insert([
            'nombre' => 'PRELIMINAR'
        ]);

        DB::table('estado_visitas')->insert([
            'nombre' => 'CONFIRMADA'
        ]);

        DB::table('estado_visitas')->insert([
            'nombre' => 'CERRADA'
        ]);

        DB::table('estado_visitas')->insert([
            'nombre' => 'REALIZADA'
        ]);

        DB::table('estado_visitas')->insert([
            'nombre' => 'CANCELADA'
        ]);
    }
}
