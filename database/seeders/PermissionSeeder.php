<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::get()->first();

        $models = [
            'admins',
            'roles',
            'users',
            'brands',
            'categories',
            'awards',
            'experiences',
            'regions',
            'service',
            'settings',
            'packages'


        ];

        $names =
            [
                ['label' => "view", 'name' => 'view'],
                ['label' => "show", 'name' => 'show'],
                ['label' => "create", 'name' => 'create'],
                ['label' => "update", 'name' => 'update'],
                ['label' => "delete", 'name' => 'delete'],
            ];

        foreach ($models as $model) {
            foreach ($names as $name) {
                $permission =  Permission::firstOrCreate([
                    'name'  => $name['name'] . '_' . $model,
                    'label' => $name['label'] . ' ' . strtolower(trim(str_replace('_', ' ', trim($model)))),
                    'action' => $name['name'],
                    'category' => $model
                ]);
                if ($permission->wasRecentlyCreated) {
                    $superAdmin->allowTo($permission);
                }
            }
        }

        // Special Apilities
        $models = [
            'reports',
            'dashboard'
        ];

        $names =
            [
                ['label' => "view", 'name' => 'view'],
            ];

        foreach ($models as $model) {
            foreach ($names as $name) {
                $permission =  Permission::firstOrCreate([
                    'name'  => $name['name'] . '_' . $model,
                    'label' => $name['label'] . ' ' . strtolower(trim(str_replace('_', ' ', trim($model)))),
                    'action' => $name['name'],
                    'category' => $model
                ]);
                if ($permission->wasRecentlyCreated) {
                    $superAdmin->allowTo($permission);
                }
            }
        }
    }
}
