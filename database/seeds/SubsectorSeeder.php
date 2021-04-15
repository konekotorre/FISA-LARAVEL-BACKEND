<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubsectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subsectors')->insert([
            'nombre' => 'Agricultura',
            'descripcion' => 'Agricultura',
            'sector_id' => '1'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Alimentos y Bebidas',
            'descripcion' => 'Alimentos y Bebidas',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Comercio',
            'descripcion' => 'Comercio',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Construcción',
            'descripcion' => 'Construcción',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Farmacéutico',
            'descripcion' => 'Farmacéutico',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Industrial y Manufactura',
            'descripcion' => 'Industrial y Manufactura',
            'sector_id' => '2'
        ]);
        
        DB::table('subsectors')->insert([
            'nombre' => 'Minero Energetico Extrativo',
            'descripcion' => 'Minero Energetico Extrativo',
            'sector_id' => '2'
        ]);

        //

        DB::table('subsectors')->insert([
            'nombre' => 'Educación',
            'descripcion' => 'Educación',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Financiero',
            'descripcion' => 'Financiero',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Inmobiliario',
            'descripcion' => 'Inmobiliario',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Salud',
            'descripcion' => 'Salud',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Solidario',
            'descripcion' => 'Solidario',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Tecnologia',
            'descripcion' => 'Tecnologia',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Telecomunicaciones',
            'descripcion' => 'Telecomunicaciones',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Transporte',
            'descripcion' => 'Transporte',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Turismo',
            'descripcion' => 'Turismo',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Servicios y Consultorias',
            'descripcion' => 'Servicios y Consultorias',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Cuaternario',
            'descripcion' => 'Cuaternario',
            'sector_id' => '4'
        ]);

        DB::table('subsectors')->insert([
            'nombre' => 'Quintiario',
            'descripcion' => 'Quintiario',
            'sector_id' => '5'
        ]);        
    }
}
