<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('tipo_organizacions')->insert([
        //     'id' => '1',
        //     'nombre' => 'Empresario individual (autónomo)',
        //     'descripcion' => 'un socio',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '2',
        //     'nombre' => 'Emprendedor de responsabilidad limitada',
        //     'descripcion' => 'Un socio',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '3',
        //     'nombre' => 'Comunidad de bienes',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '4',
        //     'nombre' => 'Sociedad Civil',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '5',
        //     'nombre' => 'Sociedad Colectiva',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '6',
        //     'nombre' => 'Sociedad Comanditaria Simple (SenC)',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '7',
        //     'nombre' => 'Sociedad de Responsabilidad Limitada (SRL o SL)',
        //     'descripcion' => 'Mínimo un socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '8',
        //     'nombre' => 'Sociedad Limitada de Formación Sucesiva (SLFS)',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '9',
        //     'nombre' => 'Sociedad Limitada Nueva Empresa (SLNE)',
        //     'descripcion' => 'De uno a cinco socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '10',
        //     'nombre' => 'Sociedad Anónima (SA)',
        //     'descripcion' => 'Mínimo un socio',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '11',
        //     'nombre' => 'Sociedad Comanditaria por Acciones (SCom)',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '12',
        //     'nombre' => 'Sociedad de Responsabilidad Limitada Laboral (SLL)',
        //     'descripcion' => 'Mínimo un socio',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '13',
        //     'nombre' => 'Sociedad Anónima Laboral (SAL)',
        //     'descripcion' => 'Mínimo dos socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '14',
        //     'nombre' => 'Sociedad Cooperativa (SCoop)',
        //     'descripcion' => 'Mínimo tres para cooperativa de primer grado',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '15',
        //     'nombre' => 'Sociedad Cooperativa de Trabajo Asociado (CTA)',
        //     'descripcion' => 'Mínimo tres socios',
        // ]);

        // DB::table('tipo_organizacions')->insert([
        //     'id' => '16',
        //     'nombre' => 'Sociedad Agraria de Transformación (SAT)',
        //     'descripcion' => 'Mínimo tres socios',
        // ]);

        DB::table('tipo_organizacions')->insert([
            'nombre' => 'PRIVADA'
        ]);

        DB::table('tipo_organizacions')->insert([
            'nombre' => 'PÚBLICA'
        ]);
    }
}
