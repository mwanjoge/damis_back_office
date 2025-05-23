<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $models = [
            'account', 'department', 'country', 'designation',
            'embassy', 'employee', 'service', 'service_provider', 'user',
            'request', 'member', 'billable_item', 'general_line_item',
            'invoice', 'request_item', 
        ];

        $actions = ['create', 'read', 'update', 'delete'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(
                    ['name' => "{$action}_{$model}"],
                    ['group' => ucfirst($model)]
                );
            }
        }
    }
}
