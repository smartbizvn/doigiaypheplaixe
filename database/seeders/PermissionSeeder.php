<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Helpers\Helper;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = Helper::getModules();
        foreach ($modules as $moduleSlug => $module) {
            foreach ($module['actions'] as $action) {
                $slug = $moduleSlug . '_' . $action['slug'];
                $name = $action['name'] . ' ' . $module['name'];

                Permission::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => $name,
                        'slug' => $slug,
                        'desc' => $name,
                        'active' => 1,
                    ]
                );
            }
        }
    }
}
