<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_permissions = config('delivery.permissions');
        $existing_permissions = Permission::pluck('name');
        foreach ($all_permissions as $value) {
            if (!in_array($value['name'], $existing_permissions->toArray())) {
                Permission::create([
                    'label'=>$value['label'],
                    'name'=>$value['name']
                ]);
            }
        }
        //$role = Role::where('name', 'admin')->first();
        if (! $role = Role::where('name', 'admin')->first()) {
            echo "creating Admin Role";
            $role = Role::create(['name' => 'admin']);
        }
        $user = User::where('email', 'admin@gmail.net')->first();
        if (! $hasrole = $user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        foreach ($all_permissions as $value) {
            if (! $permissionexist = $role->hasPermissionTo($value['name'])) {
                $role->givePermissionTo($value['name']);
            }
        }
    }
}
