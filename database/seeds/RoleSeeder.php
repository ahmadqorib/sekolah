<?php

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
        Role::firstOrCreate(['name' => 'administrator']);
        Role::firstOrCreate(['name' => 'teacher']);

        Permission::firstOrCreate(['name' => 'role-view']);
        Permission::firstOrCreate(['name' => 'role-create']);
        Permission::firstOrCreate(['name' => 'role-delete']);
        Permission::firstOrCreate(['name' => 'role-edit']);

        Permission::firstOrCreate(['name' => 'permission-view']);
    }
}
