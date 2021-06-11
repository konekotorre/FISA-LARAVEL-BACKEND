<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            TipoDocumentoPersonaSeeder::class,
            UserSeeder::class,
            PermissionsSeeder::class,
            // PaisSeeder::class,
            // DepartamentoEstadoSeeder::class,
            // CiudadSeeder::class,
            // CiiuSeeder::class,
            // CategoriaSeeder::class,
            // ClaseSeeder::class,
            // RegimenSeeder::class,
            // SectorSeeder::class,
            // SubcategoriaSeeder::class,
            // SubsectorSeeder::class,
            // TipoOrganizacionSeeder::class,
            // TipoDocumentoOrganizacionSeeder::class,
            // TipoOficinaSeeder::class,
            // ClasificacionSeeder::class,
            // EstadoVisitaSeeder::class,
            // EstadoTareaSeeder::class,
        ]);
    }
}
