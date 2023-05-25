<?php

namespace Database\Seeders;

use App\Models\Kaban\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['В работу', 'Выполняются', 'Проверка', 'Тестирование', 'Завершенные'];

        $dataBaseName = (new Status)->getConnection()->getDatabaseName();

        $tableStatusName = (new Status)->getTable();
        $dbTableProject = $dataBaseName . "." . $tableStatusName;

        foreach ($statuses as $status) {
            DB::table($dbTableProject)->insert([
                'name' => $status
            ]);
        }
    }
}
