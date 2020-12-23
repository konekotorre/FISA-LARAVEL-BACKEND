<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed states

        DB::table('departamento_estados')->insert([
            'id' => '1',
            'nombre' => 'Amazonas',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '2',
            'nombre' => 'Antioquia',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '3',
            'nombre' => 'Arauca',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '4',
            'nombre' => 'Atlántico',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '5',
            'nombre' => 'Bolivar',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '6',
            'nombre' => 'Boyacá',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '7',
            'nombre' => 'Caldas',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '8',
            'nombre' => 'Caquetá',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '9',
            'nombre' => 'Casanare',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '10',
            'nombre' => 'Cauca',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '11',
            'nombre' => 'Cesar',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '12',
            'nombre' => 'Chocó',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '13',
            'nombre' => 'Córdoba',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '14',
            'nombre' => 'Cundinamarca',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '15',
            'nombre' => 'Guianía',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '16',
            'nombre' => 'Guaviare',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '17',
            'nombre' => 'Huila',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '18',
            'nombre' => 'La Guajira',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '19',
            'nombre' => 'Magdalena',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '20',
            'nombre' => 'Meta',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '21',
            'nombre' => 'Nariño',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '22',
            'nombre' => 'Norte de Santander',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '23',
            'nombre' => 'Putumayo',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '24',
            'nombre' => 'Quindío',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '25',
            'nombre' => 'Risaralda',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '26',
            'nombre' => 'San Andrés y Providencia',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '27',
            'nombre' => 'Santander',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '28',
            'nombre' => 'Sucre',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '29',
            'nombre' => 'Tolima',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '30',
            'nombre' => 'Valle del Cauca',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '31',
            'nombre' => 'Vaupés',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '32',
            'nombre' => 'Vichada',
            'pais_id' => '10'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '33',
            'nombre' => 'Alabama',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '34',
            'nombre' => 'Alaska',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '35',
            'nombre' => 'Arizona',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '36',
            'nombre' => 'Arkansas',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '37',
            'nombre' => 'California',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '38',
            'nombre' => 'Carolina del Norte',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '39',
            'nombre' => 'Carolina del Sur',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '40',
            'nombre' => 'Colorado',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '41',
            'nombre' => 'Connecticut',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '42',
            'nombre' => 'Dakota del Norte',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '43',
            'nombre' => 'Dakota del Sur',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '44',
            'nombre' => 'Delaware',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '45',
            'nombre' => 'Florida',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '46',
            'nombre' => 'Georgia',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '47',
            'nombre' => 'Hawái',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '48',
            'nombre' => 'Idaho',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '49',
            'nombre' => 'Illinios',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '50',
            'nombre' => 'Indiana',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '51',
            'nombre' => 'Iowa',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '52',
            'nombre' => 'Kansas',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '53',
            'nombre' => 'Kentucky',
            'pais_id' => '16'
        ]);


        DB::table('departamento_estados')->insert([
            'id' => '54',
            'nombre' => 'Luisiana',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '55',
            'nombre' => 'Maine',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '56',
            'nombre' => 'Maryland',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '57',
            'nombre' => 'Massachussets',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '58',
            'nombre' => 'Míchigan',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '59',
            'nombre' => 'Minesota',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '60',
            'nombre' => 'Misisipi',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '61',
            'nombre' => 'Misuri',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '62',
            'nombre' => 'Montana',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '63',
            'nombre' => 'Nebraska',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '64',
            'nombre' => 'Nevada',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '65',
            'nombre' => 'Nueva Jersey',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '66',
            'nombre' => 'Nueva York',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '67',
            'nombre' => 'Nuevo Hampshire',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '68',
            'nombre' => 'Nuevo Mexico',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '69',
            'nombre' => 'Ohio',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '70',
            'nombre' => 'Oklahoma',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '71',
            'nombre' => 'Oregón',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '72',
            'nombre' => 'Pensilvania',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '73',
            'nombre' => 'Rhode Island',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '74',
            'nombre' => 'Tennessee',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '75',
            'nombre' => 'Texas',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '76',
            'nombre' => 'Utah',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '77',
            'nombre' => 'Vermont',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '78',
            'nombre' => 'Virginia',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '79',
            'nombre' => 'Virginia Occidental',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '80',
            'nombre' => 'Washington',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '81',
            'nombre' => 'Wisconsin',
            'pais_id' => '16'
        ]);

        DB::table('departamento_estados')->insert([
            'id' => '82',
            'nombre' => 'Wyoming',
            'pais_id' => '16'
        ]);
    }
}
