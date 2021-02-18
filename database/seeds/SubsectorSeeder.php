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
            'id' => '1',
            'nombre' => 'Agricultura',
            'descripcion' => 'Agricultura',
            'sector_id' => '1'
        ]);

        DB::table('subsectors')->insert([
            'id' => '2',
            'nombre' => 'Alimentos y Bebidas',
            'descripcion' => 'Alimentos y Bebidas',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'id' => '3',
            'nombre' => 'Comercio',
            'descripcion' => 'Comercio',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'id' => '4',
            'nombre' => 'Construcción',
            'descripcion' => 'Construcción',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'id' => '5',
            'nombre' => 'Farmacéutico',
            'descripcion' => 'Farmacéutico',
            'sector_id' => '2'
        ]);

        DB::table('subsectors')->insert([
            'id' => '6',
            'nombre' => 'Industrial y Manufactura',
            'descripcion' => 'Industrial y Manufactura',
            'sector_id' => '2'
        ]);
        
        DB::table('subsectors')->insert([
            'id' => '7',
            'nombre' => 'Minero Energetico Extrativo',
            'descripcion' => 'Minero Energetico Extrativo',
            'sector_id' => '2'
        ]);

        //

        DB::table('subsectors')->insert([
            'id' => '8',
            'nombre' => 'Educación',
            'descripcion' => 'Educación',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '9',
            'nombre' => 'Financiero',
            'descripcion' => 'Financiero',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '10',
            'nombre' => 'Inmobiliario',
            'descripcion' => 'Inmobiliario',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '11',
            'nombre' => 'Salud',
            'descripcion' => 'Salud',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '12',
            'nombre' => 'Solidario',
            'descripcion' => 'Solidario',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '13',
            'nombre' => 'Tecnologia',
            'descripcion' => 'Tecnologia',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '14',
            'nombre' => 'Telecomunicaciones',
            'descripcion' => 'Telecomunicaciones',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '15',
            'nombre' => 'Transporte',
            'descripcion' => 'Transporte',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '16',
            'nombre' => 'Turismo',
            'descripcion' => 'Turismo',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '17',
            'nombre' => 'Servicios y Consultorias',
            'descripcion' => 'Servicios y Consultorias',
            'sector_id' => '3'
        ]);

        DB::table('subsectors')->insert([
            'id' => '18',
            'nombre' => 'Cuaternario',
            'descripcion' => 'Cuaternario',
            'sector_id' => '4'
        ]);

        DB::table('subsectors')->insert([
            'id' => '19',
            'nombre' => 'Quintiario',
            'descripcion' => 'Quintiario',
            'sector_id' => '5'
        ]);        
    }
}
