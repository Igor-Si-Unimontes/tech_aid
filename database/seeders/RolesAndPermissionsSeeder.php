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
            'view closed chamados',
            'open chamado',
            'create artigo',
            'edit artigo',
            'delete artigo',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Criar roles
        $roles = [
            'admin' => ['create chamado', 'edit chamado', 'close chamado', 'view closed chamados', 'create artigo', 'edit artigo', 'delete artigo'],
            'tech' => ['close chamado', 'view closed chamados', 'open chamado'],
            'user' => ['edit chamado', 'create chamado', 'view closed chamados', 'close chamado'],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        $this->command->info('Roles, permissions e usuários iniciais criados com sucesso!');
    }
}
