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
        $admin = Role::create(['name' => 'Administrador']);

        $empleado = Role::create(['name' => 'Empleado']);

        // Asign roles
        $user01 = User::find(1);
        $user01->assignRole($admin);

        $user02 = User::find(2);
        $user02->assignRole($empleado);

        //
    }
}
