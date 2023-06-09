<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Jefe']);
        Permission::create([
            'name' => 'admin.users.index',
            'description' => 'Listar Usuarios'
        ])->assignRole($role1);
        Permission::create([
            'name' => 'admin.users.edit',
            'description' => 'Editar Usuarios'
        ])->assignRole($role1);
        Permission::create([
            'name' => 'admin.roles.index',
            'description' => 'Listar Roles'
        ])->assignRole($role1);
        Permission::create([
            'name' => 'admin.roles.create',
            'description' => 'Crear rol'
        ])->assignRole($role1);
        Permission::create([
            'name' => 'admin.roles.edit',
            'description' => 'Editar Rol'
        ])->assignRole($role1);
        Permission::create([
            'name' => 'admin.roles.destroy',
            'description' => 'Eliminar Rol'
        ])->assignRole($role1);
     }
}