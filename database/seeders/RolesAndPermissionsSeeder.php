<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Limpar cache do Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões
        $permissions = [
            'create chamado',
            'edit chamado',
            'close chamado',
            'view closed chamados'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Criar roles
        $roles = [
            'admin' => ['create chamado', 'edit chamado', 'close chamado', 'view closed chamados'],
            'tech' => ['edit chamado', 'close chamado', 'view closed chamados'],
            'user' => ['create chamado', 'view closed chamados'],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        $this->command->info('Roles, permissions e usuários iniciais criados com sucesso!');
    }
}
