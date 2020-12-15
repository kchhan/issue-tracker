<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'delete projects']);
        Permission::create(['name' => 'edit any projects']);
        Permission::create(['name' => 'delete any projects']);

        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);
        Permission::create(['name' => 'edit any tickets']);
        Permission::create(['name' => 'delete any tickets']);

        Permission::create(['name' => 'edit user roles']);

        Permission::create(['name' => 'edit profile']);

        // create roles and assign created permissions
        $role1 = Role::create(['name' => 'super_admin']);
        $role1->givePermissionTo(Permission::all());

        $role2 = Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'create projects',
                'view projects',
                'edit any projects',
                'delete any projects',

                'create tickets',
                'view tickets',
                'edit any tickets',
                'delete any tickets',

                'edit user roles',
                'edit profile',

            ]);

        $role3 = Role::create(['name' => 'manager'])
            ->givePermissionTo([
                'create projects',
                'view projects',
                'edit projects',
                'delete projects',

                'create tickets',
                'view tickets',
                'edit tickets',
                'delete tickets',

                'edit profile',
            ]);

        $role4 = Role::create(['name' => 'developer'])
            ->givePermissionTo([
                'view projects',

                'view tickets',
                'edit tickets',

                'edit profile',
            ]);

        $role5 = Role::create(['name' => 'guest'])
            ->givePermissionTo([
                'view projects',
                'view tickets',
            ]);

        // create demo users
        $userSuperAdmin = User::factory()->create();
        $userSuperAdmin->assignRole($role1);

        $userCollection = User::factory()->count(1)->create();
        foreach ($userCollection as $user) {
            $user->assignRole($role2);
        }

        $userCollection = User::factory()->count(2)->create();
        foreach ($userCollection as $user) {
            $user->assignRole($role3);
        }

        $userCollection = User::factory()->count(5)->create();
        foreach ($userCollection as $user) {
            $user->assignRole($role4);
        }

        $userGuest = User::factory()->create();
        $userGuest->assignRole($role5);
    }
}
