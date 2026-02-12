<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Permissions ---
        $permissions = [
            // Clients
            'clients_list',
            'clients_create',
            'clients_edit',
            'clients_delete',

            // Products
            'products_list',
            'products_create',
            'products_edit',
            'products_delete',

            // Measurement Units
            'measurement_units_list',
            'measurement_units_create',
            'measurement_units_edit',
            'measurement_units_delete',

            // Roles & Users (System)
            'users_list',
            'users_create',
            'users_edit',
            'roles_list',
            'roles_create',
            'roles_edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // --- Roles ---

        // 1. Admin (All permissions)
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->syncPermissions(Permission::all());

        // 2. Vendedor (Store operations)
        $roleVendedor = Role::firstOrCreate(['name' => 'vendedor']);
        $roleVendedor->syncPermissions([
            'products_list',
            'clients_list',
            'clients_create',
            'clients_edit',
            'measurement_units_list',
        ]);

        // 3. Cliente (Read-only / My Profile)
        $roleCliente = Role::firstOrCreate(['name' => 'cliente']);
        $roleCliente->syncPermissions([
            // In a real store, a client might not access the admin panel at all,
            // but for this request we give them limited view if they login.
            // 'products_list', 
        ]);

        // --- Default Users ---

        // Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($roleAdmin);

        // Vendedor User
        $vendedor = User::firstOrCreate(
            ['email' => 'vendedor@example.com'],
            [
                'name' => 'Vendedor Tienda',
                'password' => Hash::make('password'),
            ]
        );
        $vendedor->assignRole($roleVendedor);

        // Client User
        $client = User::firstOrCreate(
            ['email' => 'cliente@example.com'],
            [
                'name' => 'Cliente Demo',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole($roleCliente);
    }
}
