<?php

namespace Database\Seeders;

use App\Models\Kaban\Executors;
use App\Models\Kaban\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataBaseName = (new Task)->getConnection()->getDatabaseName();
        $tableTaskName = (new Task)->getTable();
        $dbTableTasks = $dataBaseName . "." . $tableTaskName;

        $tasks = [
            [
                'parent_id' => null, // null
                'project_id' => 3, // ЛК Стажер
                'team_id' => 23, // 21 оценка; 22 гант; 23 Канбан
                'name' => 'Анализ общего продукта',
                'is_on_kanban' => 0,
                'is_completed' => 0,
                'status_id' => 1,
                'planned_start_date' => '2023-05-10',
                'planned_final_date' => '2023-05-29',
                'deadline' => '2023-05-31', // null
                'completed_at' => null, // null
                'description' => 'Описание задачи' // null
            ],
            [
                'parent_id' => 1, // null
                'project_id' => 3, // ЛК Стажер
                'team_id' => 23, // 21 оценка; 22 гант; 23 Канбан
                'name' => 'Анализ базы данных и выявление ошибок',
                'is_on_kanban' => 0,
                'is_completed' => 0,
                'status_id' => 1,
                'planned_start_date' => '2023-05-10',
                'planned_final_date' => '2023-05-29',
                'deadline' => null,
                'completed_at' => null, // null
                'description' => 'Описание задачи' // null
            ],
            [
                'parent_id' => 1, // null
                'project_id' => 3, // ЛК Стажер
                'team_id' => 23, // 21 оценка; 22 гант; 23 Канбан
                'name' => 'Анализ фронта',
                'is_on_kanban' => 0,
                'is_completed' => 1,
                'status_id' => 1,
                'planned_start_date' => '2023-05-10',
                'planned_final_date' => '2023-05-29',
                'deadline' => '2023-05-31', // null
                'completed_at' => null, // null
                'description' => null // null
            ],
            [
                'parent_id' => null, // null
                'project_id' => 3, // ЛК Стажер
                'team_id' => 22, // 21 оценка; 22 гант; 23 Канбан
                'name' => 'Сборка данных и аналитика',
                'is_on_kanban' => 0,
                'is_completed' => 0,
                'status_id' => 1,
                'planned_start_date' => '2023-05-10',
                'planned_final_date' => '2023-05-29',
                'deadline' => '2023-05-31', // null
                'completed_at' => null, // null
                'description' => null // null
            ],
            [
                'parent_id' => 4, // null
                'project_id' => 3, // ЛК Стажер
                'team_id' => 22, // 21 оценка; 22 гант; 23 Канбан
                'name' => 'Ознакомиться с фигмой оценки',
                'is_on_kanban' => 0,
                'is_completed' => 0,
                'status_id' => 1,
                'planned_start_date' => '2023-05-10',
                'planned_final_date' => '2023-05-29',
                'deadline' => '2023-05-31', // null
                'completed_at' => null, // null
                'description' => null // null
            ],
        ];

        $tableTaskExecutors = (new Executors)->getTable();
        $dbTableExecutors = $dataBaseName . "." . $tableTaskExecutors;

        $executors = [
            [
                'task_id' => 1,
                'user_id' => 1,
                'role_id' => 1,
                'time_spent' => 0
            ],
            [
                'task_id' => 2,
                'user_id' => 2,
                'role_id' => 1,
                'time_spent' => 0
            ],
            [
                'task_id' => 3,
                'user_id' => 3,
                'role_id' => 1,
                'time_spent' => 0
            ],
            [
                'task_id' => 4,
                'user_id' => 4,
                'role_id' => 1,
                'time_spent' => 0
            ],
            [
                'task_id' => 5,
                'user_id' => 5,
                'role_id' => 1,
                'time_spent' => 0
            ],
        ];

        foreach ($tasks as $task) {
            DB::table($dbTableTasks)->insert($task);
        }

        foreach ($executors as $executor) {
            DB::table($dbTableExecutors)->insert($executor);
        }
    }
}
