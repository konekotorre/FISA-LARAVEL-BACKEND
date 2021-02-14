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
            'nombre' => 'NUEVA'
        ]);

        DB::table('estado_tareas')->insert([
            'id' => '2',
            'nombre' => 'EN PROCESO'
        ]);

        DB::table('estado_tareas')->insert([
            'id' => '3',
            'nombre' => 'FINALIZADA'
        ]);

        DB::table('estado_tareas')->insert([
            'id' => '4',
            'nombre' => 'INCONVENIENTES'
        ]);

        DB::table('estado_tareas')->insert([
            'id' => '5',
            'nombre' => 'CANCELADA'
        ]);

    }
}
