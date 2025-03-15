<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cache reset
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        // patients
        Permission::create(['name' => 'create-patient']);
        Permission::create(['name' => 'update-patient']);
        Permission::create(['name' => 'view-patient']);
        Permission::create(['name' => 'delete-patient']);

        // Primary medical forms
        Permission::create(['name' => 'create-primary-medical-form']);
        Permission::create(['name' => 'update-primary-medical-form']);
        Permission::create(['name' => 'view-primary-medical-form']);
        Permission::create(['name' => 'delete-primary-medical-form']);

        // Secondary medical forms
        Permission::create(['name' => 'create-secondary-medical-form']);
        Permission::create(['name' => 'update-secondary-medical-form']);
        Permission::create(['name' => 'view-secondary-medical-form']);
        Permission::create(['name' => 'delete-secondary-medical-form']);

        // Manager users
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'update-users']);
        Permission::create(['name' => 'delete-users']);

        // Create roles and grant permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([ 'create-users', 'view-users', 'update-users', 'delete-users' ]);

        $basic = Role::create(['name' => 'basic']);
        $basic->givePermissionTo([ 'create-patient', 'update-patient', 'view-patient' ]);

        $primary = Role::create(['name' => 'primary']);
        $primary->givePermissionTo([
            'create-patient', 'update-patient', 'view-patient',
            'create-primary-medical-form', 'update-primary-medical-form', 'view-primary-medical-form'
        ]);

        $secondary = Role::create(['name' => 'secondary']);
        $secondary->givePermissionTo([
            'create-patient', 'update-patient', 'view-patient',
            'create-secondary-medical-form', 'update-secondary-medical-form', 'view-secondary-medical-form'
        ]);

        $other = Role::create(['name' => 'other']);
        $other->givePermissionTo([
            'create-patient', 'update-patient', 'view-patient'
        ]);
    }
}
