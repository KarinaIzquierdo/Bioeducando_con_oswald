<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Crear Roles
        $adminRole = Role::updateOrCreate(['id' => 1], ['name' => 'admin']);
        Role::updateOrCreate(['id' => 2], ['name' => 'docente']);
        Role::updateOrCreate(['id' => 3], ['name' => 'usuario']);

        // Crear Usuario Administrador por defecto si no existe
        User::updateOrCreate(
            ['email' => 'admin@bio.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]
        );
    }
}
