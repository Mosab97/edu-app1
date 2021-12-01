<?php

use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $this->managerPermissions();
    }

    private function managerPermissions()
    {
        $permissions = MANAGER_PERMISSIONS;
        foreach ($permissions as $permission) {
            if (Permission::where('name', $permission)->where('guard_name', 'manager')->count() == 0)
                Permission::create(['name' => $permission, 'guard_name' => 'manager']);
            foreach (\App\Models\Manager::get() as $index => $item) {
                if (!$item->can($permission)) $item->givePermissionTo($permission);
            }
        }
    }
}
