<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoTareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_tareas')->insert([
            'id' => '1',
            'nombre' => 'Nueva'
        ]);

        DB::table('estado_tareas')->insert([
            'id' => '2',
            'nombre' => 'En proceso'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '3',
            'nombre' => 'Finalizada'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '4',
            'nombre' => 'Inconvenientes'
        ]);

        DB::table('estado_visitas')->insert([
            'id' => '5',
            'nombre' => 'Cancelada'
        ]);

    }
}
