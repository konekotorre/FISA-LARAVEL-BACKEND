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
            'id' => '1',
            'nombre' => 'AGENDADA'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '2',
            'nombre' => 'PRELIMINAR'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '3',
            'nombre' => 'CONFIRMADA'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '4',
            'nombre' => 'CERRADA'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '5',
            'nombre' => 'REALIZADA'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '6',
            'nombre' => 'CANCELADA'
        ]);
    }
}
