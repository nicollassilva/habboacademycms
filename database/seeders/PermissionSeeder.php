<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    protected Array $filamentResources = [
        'Article', 'ArticleCategory',
        'Topic', 'TopicCategory', 'TopicComment',
        'User'
    ];

    protected Array $rolesWithPermissions = [
        'Administrador' => [
            'view',
            'view_any',
            'create',
            'delete',
            'delete_any',
            'update'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $user = User::find(1);

        forEach($this->filamentResources as $filamentResource) {
            $filamentResource = \Str::lower($filamentResource);

            forEach($this->rolesWithPermissions as $roleName => $permissions) {
                if(!isset($role) || $role->name != $roleName) {
                    $role = Role::create(['name' => $roleName]);
                }
                
                collect($permissions)->each(function ($permission) use ($filamentResource, $role) {
                    $permission = Permission::create(['name' => "{$permission}_{$filamentResource}"]);
                    $role->givePermissionTo($permission);
                });
            }
        }

        $firstRole = Role::firstOrFail();
        $user->roles()->attach($firstRole);
    }
}
