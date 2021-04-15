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
            'nombre' => 'NUEVA'
        ]);

        DB::table('estado_tareas')->insert([
            'nombre' => 'EN PROCESO'
        ]);

        DB::table('estado_tareas')->insert([
            'nombre' => 'FINALIZADA'
        ]);

        DB::table('estado_tareas')->insert([
            'nombre' => 'INCONVENIENTES'
        ]);

        DB::table('estado_tareas')->insert([
            'nombre' => 'CANCELADA'
        ]);

    }
}
