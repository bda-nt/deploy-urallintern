<?php

namespace Database\Seeders;

use App\Models\Kaban\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Ответственный'];

        $dataBaseName = (new Roles)->getConnection()->getDatabaseName();

        $tableRolesName = (new Roles)->getTable();
        $dbTableProject = $dataBaseName . "." . $tableRolesName;

        foreach ($statuses as $status) {
            DB::table($dbTableProject)->insert([
                'name' => $status
            ]);
        }
    }
}
