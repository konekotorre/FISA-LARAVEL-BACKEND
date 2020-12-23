<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed cities

        DB::table('ciudads')->insert([
            'id' => '1',
            'nombre' => 'Leticia',
            'departamento_estado_id' => '1'
        ]);

        DB::table('ciudads')->insert([
            'id' => '2',
            'nombre' => 'Medellin',
            'departamento_estado_id' => '2'
        ]);

        DB::table('ciudads')->insert([
            'id' => '3',
            'nombre' => 'Arauca',
            'departamento_estado_id' => '3'
        ]);

        DB::table('ciudads')->insert([
            'id' => '4',
            'nombre' => 'Barranquilla',
            'departamento_estado_id' => '4'
        ]);

        DB::table('ciudads')->insert([
            'id' => '5',
            'nombre' => 'Cartagena',
            'departamento_estado_id' => '5'
        ]);

        DB::table('ciudads')->insert([
            'id' => '6',
            'nombre' => 'Tunja',
            'departamento_estado_id' => '6'
        ]);

        DB::table('ciudads')->insert([
            'id' => '7',
            'nombre' => 'Manizales',
            'departamento_estado_id' => '7'
        ]);

        DB::table('ciudads')->insert([
            'id' => '8',
            'nombre' => 'Florencia',
            'departamento_estado_id' => '8'
        ]);

        DB::table('ciudads')->insert([
            'id' => '9',
            'nombre' => 'Yopal',
            'departamento_estado_id' => '9'
        ]);

        DB::table('ciudads')->insert([
            'id' => '10',
            'nombre' => 'Popayán',
            'departamento_estado_id' => '10'
        ]);

        DB::table('ciudads')->insert([
            'id' => '11',
            'nombre' => 'Valledupar',
            'departamento_estado_id' => '11'
        ]);

        DB::table('ciudads')->insert([
            'id' => '12',
            'nombre' => 'Quindó',
            'departamento_estado_id' => '12'
        ]);

        DB::table('ciudads')->insert([
            'id' => '13',
            'nombre' => 'Monteria',
            'departamento_estado_id' => '13'
        ]);

        DB::table('ciudads')->insert([
            'id' => '14',
            'nombre' => 'Bogotá',
            'departamento_estado_id' => '14'
        ]);

        DB::table('ciudads')->insert([
            'id' => '15',
            'nombre' => 'Inírida',
            'departamento_estado_id' => '15'
        ]);

        DB::table('ciudads')->insert([
            'id' => '16',
            'nombre' => 'San José del Guaviare',
            'departamento_estado_id' => '16'
        ]);

        DB::table('ciudads')->insert([
            'id' => '17',
            'nombre' => 'Neiva',
            'departamento_estado_id' => '17'
        ]);

        DB::table('ciudads')->insert([
            'id' => '18',
            'nombre' => 'Rioacha',
            'departamento_estado_id' => '18'
        ]);

        DB::table('ciudads')->insert([
            'id' => '19',
            'nombre' => 'Santamarta',
            'departamento_estado_id' => '19'
        ]);

        DB::table('ciudads')->insert([
            'id' => '20',
            'nombre' => 'Villavicencio',
            'departamento_estado_id' => '20'
        ]);

        DB::table('ciudads')->insert([
            'id' => '21',
            'nombre' => 'Pasto',
            'departamento_estado_id' => '21'
        ]);

        DB::table('ciudads')->insert([
            'id' => '22',
            'nombre' => 'Cúcuta',
            'departamento_estado_id' => '22'
        ]);

        DB::table('ciudads')->insert([
            'id' => '23',
            'nombre' => 'Mocoa',
            'departamento_estado_id' => '23'
        ]);

        DB::table('ciudads')->insert([
            'id' => '24',
            'nombre' => 'Armenia',
            'departamento_estado_id' => '24'
        ]);

        DB::table('ciudads')->insert([
            'id' => '25',
            'nombre' => 'Pereira',
            'departamento_estado_id' => '25'
        ]);

        DB::table('ciudads')->insert([
            'id' => '26',
            'nombre' => 'San Andrés',
            'departamento_estado_id' => '26'
        ]);

        DB::table('ciudads')->insert([
            'id' => '27',
            'nombre' => 'Bucaramanga',
            'departamento_estado_id' => '27'
        ]);

        DB::table('ciudads')->insert([
            'id' => '28',
            'nombre' => 'Sincelejo',
            'departamento_estado_id' => '28'
        ]);

        DB::table('ciudads')->insert([
            'id' => '29',
            'nombre' => 'Ibagué',
            'departamento_estado_id' => '29'
        ]);

        DB::table('ciudads')->insert([
            'id' => '30',
            'nombre' => 'Cali',
            'departamento_estado_id' => '30'
        ]);

        DB::table('ciudads')->insert([
            'id' => '31',
            'nombre' => 'Mitú',
            'departamento_estado_id' => '31'
        ]);

        DB::table('ciudads')->insert([
            'id' => '32',
            'nombre' => 'Puerto Carreño',
            'departamento_estado_id' => '32'
        ]);

        DB::table('ciudads')->insert([
            'id' => '33',
            'nombre' => 'Montgomery',
            'departamento_estado_id' => '33'
        ]);

        DB::table('ciudads')->insert([
            'id' => '34',
            'nombre' => 'Juneau',
            'departamento_estado_id' => '34'
        ]);

        DB::table('ciudads')->insert([
            'id' => '35',
            'nombre' => 'Phoenix',
            'departamento_estado_id' => '35'
        ]);

        DB::table('ciudads')->insert([
            'id' => '36',
            'nombre' => 'Little Rock',
            'departamento_estado_id' => '36'
        ]);

        DB::table('ciudads')->insert([
            'id' => '37',
            'nombre' => 'Sacramento',
            'departamento_estado_id' => '37'
        ]);

        DB::table('ciudads')->insert([
            'id' => '38',
            'nombre' => 'Raleigh',
            'departamento_estado_id' => '38'
        ]);

        DB::table('ciudads')->insert([
            'id' => '39',
            'nombre' => 'Columbia',
            'departamento_estado_id' => '39'
        ]);

        DB::table('ciudads')->insert([
            'id' => '40',
            'nombre' => 'Denver',
            'departamento_estado_id' => '40'
        ]);

        DB::table('ciudads')->insert([
            'id' => '41',
            'nombre' => 'Hartford',
            'departamento_estado_id' => '41'
        ]);

        DB::table('ciudads')->insert([
            'id' => '42',
            'nombre' => 'Bismarck',
            'departamento_estado_id' => '42'
        ]);

        DB::table('ciudads')->insert([
            'id' => '43',
            'nombre' => 'Pierre',
            'departamento_estado_id' => '43'
        ]);

        DB::table('ciudads')->insert([
            'id' => '44',
            'nombre' => 'Dover',
            'departamento_estado_id' => '44'
        ]);

        DB::table('ciudads')->insert([
            'id' => '45',
            'nombre' => 'Tallahassee',
            'departamento_estado_id' => '45'
        ]);

        DB::table('ciudads')->insert([
            'id' => '46',
            'nombre' => 'Atlanta',
            'departamento_estado_id' => '46'
        ]);

        DB::table('ciudads')->insert([
            'id' => '47',
            'nombre' => 'Honolulu',
            'departamento_estado_id' => '47'
        ]);

        DB::table('ciudads')->insert([
            'id' => '48',
            'nombre' => 'Boise',
            'departamento_estado_id' => '48'
        ]);

        DB::table('ciudads')->insert([
            'id' => '49',
            'nombre' => 'Springfield',
            'departamento_estado_id' => '49'
        ]);

        DB::table('ciudads')->insert([
            'id' => '50',
            'nombre' => 'Indianápolis',
            'departamento_estado_id' => '50'
        ]);

        DB::table('ciudads')->insert([
            'id' => '51',
            'nombre' => 'Des Moines',
            'departamento_estado_id' => '51'
        ]);

        DB::table('ciudads')->insert([
            'id' => '52',
            'nombre' => 'Topeka',
            'departamento_estado_id' => '52'
        ]);

        DB::table('ciudads')->insert([
            'id' => '53',
            'nombre' => 'Frankfort',
            'departamento_estado_id' => '53'
        ]);


        DB::table('ciudads')->insert([
            'id' => '54',
            'nombre' => 'Baton Rouge',
            'departamento_estado_id' => '54'
        ]);

        DB::table('ciudads')->insert([
            'id' => '55',
            'nombre' => 'Augusta',
            'departamento_estado_id' => '55'
        ]);

        DB::table('ciudads')->insert([
            'id' => '56',
            'nombre' => 'Annapolis',
            'departamento_estado_id' => '56'
        ]);

        DB::table('ciudads')->insert([
            'id' => '57',
            'nombre' => 'Boston',
            'departamento_estado_id' => '57'
        ]);

        DB::table('ciudads')->insert([
            'id' => '58',
            'nombre' => 'Lansing',
            'departamento_estado_id' => '58'
        ]);

        DB::table('ciudads')->insert([
            'id' => '59',
            'nombre' => 'Saint Paul',
            'departamento_estado_id' => '59'
        ]);

        DB::table('ciudads')->insert([
            'id' => '60',
            'nombre' => 'Jackson',
            'departamento_estado_id' => '60'
        ]);

        DB::table('ciudads')->insert([
            'id' => '61',
            'nombre' => 'Jefferson City',
            'departamento_estado_id' => '61'
        ]);

        DB::table('ciudads')->insert([
            'id' => '62',
            'nombre' => 'Helena',
            'departamento_estado_id' => '62'
        ]);

        DB::table('ciudads')->insert([
            'id' => '63',
            'nombre' => 'Lincoln',
            'departamento_estado_id' => '63'
        ]);

        DB::table('ciudads')->insert([
            'id' => '64',
            'nombre' => 'Carson City',
            'departamento_estado_id' => '64'
        ]);

        DB::table('ciudads')->insert([
            'id' => '65',
            'nombre' => 'Trenton',
            'departamento_estado_id' => '65'
        ]);

        DB::table('ciudads')->insert([
            'id' => '66',
            'nombre' => 'Albany',
            'departamento_estado_id' => '66'
        ]);

        DB::table('ciudads')->insert([
            'id' => '67',
            'nombre' => 'Concord',
            'departamento_estado_id' => '67'
        ]);

        DB::table('ciudads')->insert([
            'id' => '68',
            'nombre' => 'Santa Fe',
            'departamento_estado_id' => '68'
        ]);

        DB::table('ciudads')->insert([
            'id' => '69',
            'nombre' => 'Columbus',
            'departamento_estado_id' => '69'
        ]);

        DB::table('ciudads')->insert([
            'id' => '70',
            'nombre' => 'Oklahoma City',
            'departamento_estado_id' => '70'
        ]);

        DB::table('ciudads')->insert([
            'id' => '71',
            'nombre' => 'Salem',
            'departamento_estado_id' => '71'
        ]);

        DB::table('ciudads')->insert([
            'id' => '72',
            'nombre' => 'Harrisburg',
            'departamento_estado_id' => '72'
        ]);

        DB::table('ciudads')->insert([
            'id' => '73',
            'nombre' => 'Providence',
            'departamento_estado_id' => '73'
        ]);

        DB::table('ciudads')->insert([
            'id' => '74',
            'nombre' => 'Nashville',
            'departamento_estado_id' => '74'
        ]);

        DB::table('ciudads')->insert([
            'id' => '75',
            'nombre' => 'Austin',
            'departamento_estado_id' => '75'
        ]);

        DB::table('ciudads')->insert([
            'id' => '76',
            'nombre' => 'Salt Lake City',
            'departamento_estado_id' => '76'
        ]);

        DB::table('ciudads')->insert([
            'id' => '77',
            'nombre' => 'Montpelier',
            'departamento_estado_id' => '77'
        ]);

        DB::table('ciudads')->insert([
            'id' => '78',
            'nombre' => 'Richmond',
            'departamento_estado_id' => '78'
        ]);

        DB::table('ciudads')->insert([
            'id' => '79',
            'nombre' => 'Charleston',
            'departamento_estado_id' => '79'
        ]);

        DB::table('ciudads')->insert([
            'id' => '80',
            'nombre' => 'Olympia',
            'departamento_estado_id' => '80'
        ]);

        DB::table('ciudads')->insert([
            'id' => '81',
            'nombre' => 'Madison',
            'departamento_estado_id' => '81'
        ]);

        DB::table('ciudads')->insert([
            'id' => '82',
            'nombre' => 'Cheyenne',
            'departamento_estado_id' => '82'
        ]);



    }
}
