<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sectors')->insert([
            'id' => '1',
            'nombre' => 'Sector Primario',
            'descripcion' => 'Transformacion de los recursos naturales en productos primarios no elaborados'
        ]);

        DB::table('sectors')->insert([
            'id' => '2',
            'nombre' => 'Sector Secundario',
            'descripcion' => 'Actividad artesanal e industrial'
        ]);

        DB::table('sectors')->insert([
            'id' => '3',
            'nombre' => 'Sector Terciario',
            'descripcion' => 'Actividades relacionadas con los servicios no productores o transformadores de bienes materiales'
        ]);

        DB::table('sectors')->insert([
            'id' => '4',
            'nombre' => 'Sector Cuaternario',
            'descripcion' => 'Actividades especializadas de investigación, desarrollo, innovación e información'
        ]);

        DB::table('sectors')->insert([
            'id' => '5',
            'nombre' => 'Sector Quinario',
            'descripcion' => 'Servicios sin animo de lucro relacionados con la cultura, la educación, el arte y el entretenimiento'
        ]);
    }
}
