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
            'nombre' => 'Agendada'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '2',
            'nombre' => 'Preliminar'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '3',
            'nombre' => 'Confirmada'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '4',
            'nombre' => 'Cerrada'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '5',
            'nombre' => 'Realizada'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '6',
            'nombre' => 'Cancelada'
        ]);
    }
}
