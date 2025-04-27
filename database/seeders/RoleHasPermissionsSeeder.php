<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 2],
            ['permission_id' => 5, 'role_id' => 3],
            ['permission_id' => 6, 'role_id' => 2],
            ['permission_id' => 7, 'role_id' => 2],
            ['permission_id' => 8, 'role_id' => 2],
            ['permission_id' => 10, 'role_id' => 2],
            ['permission_id' => 11, 'role_id' => 2],
            ['permission_id' => 12, 'role_id' => 2],
            ['permission_id' => 13, 'role_id' => 2],
            ['permission_id' => 14, 'role_id' => 2],
            ['permission_id' => 16, 'role_id' => 2],
            ['permission_id' => 19, 'role_id' => 1],
            ['permission_id' => 19, 'role_id' => 2],
            ['permission_id' => 20, 'role_id' => 2],
        ];

        DB::table('role_has_permissions')->insert($data);
    }
}
