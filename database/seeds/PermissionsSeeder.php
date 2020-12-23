<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating permissions

        // $permisos_admin = [

        //     'role-index',
        //     'role-show',

        //     'user-index',
        //     'user-store',
        //     'user-show',
        //     'user-update',
        //     'user-destroy'

        // ];

        // $permisos_empleado = [

        //     'archivo-index',
        //     'archivo-upload',
        //     'archivo-download',
        //     'archivo-destroy',

        //     'categoria-index',
        //     'categoria-store',
        //     'categoria-show',
        //     'categoria-update',
        //     'categoria-destroy',

        //     'ciiu-index',
        //     'ciiu-store',
        //     'ciiu-show',
        //     'ciiu-update',
        //     'ciiu-destroy',

        //     'ciudad-index',
        //     'ciudad-store',
        //     'ciudad-show',
        //     'ciudad-update',
        //     'ciudad-destroy',

        //     'clase-index',
        //     'clase-store',
        //     'clase-show',
        //     'clase-update',
        //     'clase-destroy',

        //     'contacto-index',
        //     'contacto-indexOrganizacion',
        //     'contacto-indexOficina',
        //     'contacto-search',
        //     'contacto-store',
        //     'contacto-show',
        //     'contacto-update',
        //     'contacto-destroy',

        //     'departamentoEstado-index',
        //     'departamentoEstado-store',
        //     'departamentoEstado-show',
        //     'departamentoEstado-update',
        //     'departamentoEstado-destroy',

        //     'detalleActividadEconomica-index',
        //     'detalleActividadEconomica-store',
        //     'detalleActividadEconomica-update',
        //     'detalleActividadEconomica-destroy',

        //     'detalleCategoriaContacto-index',
        //     'detalleCategoriaContacto-store',
        //     'detalleCategoriaContacto-update',
        //     'detalleCategoriaContacto-destroy',

        //     'informacionFinanciera-index',
        //     'informacionFinanciera-store',
        //     'informacionFinanciera-update',
        //     'informacionFinanciera-destroy',

        //     'oficina-index',
        //     'oficina-store',
        //     'oficina-show',
        //     'oficina-update',
        //     'oficina-destroy',

        //     'organizacion-index',
        //     'organizacion-search',
        //     'organizacion-store',
        //     'organizacion-show',
        //     'organizacion-update',
        //     'organizacion-destroy',

        //     'pais-index',
        //     'pais-store',
        //     'pais-show',
        //     'pais-update',
        //     'pais-destroy',

        //     'regimen-index',
        //     'regimen-store',
        //     'regimen-show',
        //     'regimen-update',
        //     'regimen-destroy',

        //     'sector-index',
        //     'sector-store',
        //     'sector-show',
        //     'sector-update',
        //     'sector-destroy',

        //     'subcategoria-index',
        //     'subcategoria-store',
        //     'subcategoria-show',
        //     'subcategoria-update',
        //     'subcategoria-destroy',

        //     'subsector-index',
        //     'subsector-store',
        //     'subsector-show',
        //     'subsector-update',
        //     'subsector-destroy',

        //     'tarea-index',
        //     'tarea-store',
        //     'tarea-show',
        //     'tarea-update',
        //     'tarea-destroy',

        //     'tipoDocumentoOrganizacion-index',
        //     'tipoDocumentoOrganizacion-store',
        //     'tipoDocumentoOrganizacion-show',
        //     'tipoDocumentoOorganizacion-update',
        //     'tipoDocumentoOrganizacion-destroy',

        //     'tipoDocumentoPersona-index',
        //     'tipoDocumentoPersona-store',
        //     'tipoDocumentoPersona-show',
        //     'tipoDocumentoPersona-update',
        //     'tipoDocumentoPersona-destroy',

        //     'tipoOficina-index',
        //     'tipoOficina-store',
        //     'tipoOficina-show',
        //     'tipoOficina-update',
        //     'tipoOficina-destroy',

        //     'tipoOrganizacion-index',
        //     'tipoOrganizacion-store',
        //     'tipoOrganizacion-show',
        //     'tipoOrganizacion-update',
        //     'tipoOrganizacion-destroy',

        //     'visita-index',
        //     'visita-indexOrganizacion',
        //     'visita-search',
        //     'visita-store',
        //     'visita-show',
        //     'visita-update',
        //     'visita-destroy'

        // ];

        // foreach ($permisos_admin as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        // foreach ($permisos_empleado as $permissions) {
        //     Permission::create(['name' => $permissions]);
        // }

        // //Creating roles

        $admin = Role::create(['name' => 'Administrador']);

        $empleado = Role::create(['name' => 'Empleado']);

        // $admin->givePermissionTo([$permisos_admin, $permisos_empleado]);

        // $empleado->givePermissionTo($permisos_empleado);

        // Asign roles
        $user01 = User::find(1);
        $user01->assignRole($admin);

        $user02 = User::find(2);
        $user02->assignRole($empleado);

        //
    }
}
