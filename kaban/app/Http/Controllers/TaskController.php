<?php

namespace App\Http\Controllers;


use App\Models\Auth\User;
use App\Models\Kaban\Task;
use App\Models\Auth\Command;
use App\Models\Auth\Project;
use App\Models\Kaban\Stages;
use Illuminate\Http\Request;
use App\Models\Kaban\Comments;
use App\Models\Kaban\Executors;
use App\Http\Requests\TaskShowRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskDestroyRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataBaseName = (new Project)->getConnection()->getDatabaseName();

        $tableProjectName = (new Project)->getTable();
        $dbTableProject = $dataBaseName . "." . $tableProjectName;

        $tableTeamName = (new Command)->getTable();
        $dbTableTeam = $dataBaseName . "." . $tableTeamName;

        $tableUserName = (new User)->getTable();
        $dbTableUser = $dataBaseName . "." . $tableUserName;

        $tasks = Task::join($dbTableProject, function ($join) use ($dbTableProject) {
            $join->on($dbTableProject . ".id", "=", "tasks.project_id");
        })
            ->join($dbTableTeam, function ($join) use ($dbTableTeam) {
                $join->on($dbTableTeam . ".id", "=", "tasks.team_id");
            })
            ->join("executors", function ($join) {
                $join->on("executors.task_id", "=", "tasks.id");
            })
            ->join($dbTableUser, function ($join) use ($dbTableUser) {
                $join->on($dbTableUser . ".id", "=", "executors.user_id");
            })
            ->join("statuses", function ($join) {
                $join->on("tasks.status_id", "=", "statuses.id");
            })
            ->where('tasks.is_on_kanban', '=', true)
            ->where('executors.role_id', '=', 1) // Ответственный
            ->get([
                "tasks.id AS task_id", "tasks.name AS task_name",
                "tasks.project_id", $dbTableProject . ".title AS project_name",
                "tasks.team_id", $dbTableTeam . ".title AS team_name", $dbTableTeam . ".teg AS team_tag",
                "executors.user_id AS responsible_id", $dbTableUser . ".first_name AS responsible_first_name",
                $dbTableUser . ".last_name AS responsible_last_name", $dbTableUser . ".patronymic AS responsible_patronymic",
                "tasks.deadline", "tasks.status_id", "statuses.name AS status_name",
            ]);
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'parent_id' => $request->parent_id,
            'project_id' => $request->project_id,
            'team_id' => $request->team_id,
            'name' => $request->task_name,
            'is_on_kanban' => false,
            'is_completed' => false,
            'status_id' => 1, // В работу
            'planned_start_date' => $request->planned_start_date,
            'planned_final_date' => $request->planned_final_date,
            'deadline' => $request->deadline,
            'completed_at' => null,
            'description' => $request->description,
        ]);
        $executors = Executors::create([
            'task_id' => $task->id,
            'user_id' => $request->responsible_id, // добавить автора создания с авторизованного пользователя
            'role_id' => 1, // ответственный
            'time_spent' => 0
        ]);


        $stages = array();
        $res = [];
        if ($request->stages !== null) {
            foreach ($request->stages as $key => $stage) {
                $stages[] = new Stages(['description' => $stage, 'is_ready' => false]);
            }
            $res = $task->stages()->saveMany($stages);
        }

        return $res = ["task" => $task, "executors" => $executors, "stages" => $res,];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TaskShowRequest $request)
    {

        $dataBaseName = (new Project)->getConnection()->getDatabaseName();

        $tableProjectName = (new Project)->getTable();
        $dbTableProject = $dataBaseName . "." . $tableProjectName;

        $tableTeamName = (new Command)->getTable();
        $dbTableTeam = $dataBaseName . "." . $tableTeamName;

        $tableUserName = (new User)->getTable();
        $dbTableUser = $dataBaseName . "." . $tableUserName;

        $task = Task::join($dbTableProject, function ($join) use ($dbTableProject) {
            $join->on($dbTableProject . ".id", "=", "tasks.project_id");
        })
            ->join($dbTableTeam, function ($join) use ($dbTableTeam) {
                $join->on($dbTableTeam . ".id", "=", "tasks.team_id");
            })
            ->join("executors", function ($join) {
                $join->on("executors.task_id", "=", "tasks.id");
            })
            ->join($dbTableUser, function ($join) use ($dbTableUser) {
                $join->on($dbTableUser . ".id", "=", "executors.user_id");
            })
            ->join("statuses", function ($join) {
                $join->on("tasks.status_id", "=", "statuses.id");
            })
            ->where('executors.role_id', '=', 1) // Ответственный
            ->select([
                "tasks.parent_id", "tasks.id AS task_id", "tasks.name AS task_name",
                "tasks.project_id", $dbTableProject . ".title AS project_name",
                "tasks.team_id", $dbTableTeam . ".title AS team_name", $dbTableTeam . ".teg AS team_tag",
                "executors.id AS responsible_id", $dbTableUser . ".first_name AS responsible_first_name",
                $dbTableUser . ".last_name AS responsible_last_name", $dbTableUser . ".patronymic AS responsible_patronymic",
                "executors.time_spent AS responsible_time_spent",
                "tasks.deadline", "tasks.planned_start_date", "tasks.planned_final_date",
                "tasks.is_on_kanban", "tasks.is_completed",
                "tasks.status_id", "statuses.name AS status_name",
                "tasks.completed_at", "tasks.description",
            ])
            ->find($request->taskId);

        if ($task !== null) {
            $stages = Stages::where('task_id', '=', $request->taskId)
                ->get(['stages.id', 'stages.description', 'stages.is_ready']);

            $comments = Comments::join($dbTableUser, function ($join) use ($dbTableUser) {
                $join->on($dbTableUser . ".id", "=", "comments.user_id");
            })
                ->where('task_id', '=', $request->taskId)
                ->get([
                    'comments.id', 'comments.user_id AS author_id',
                    $dbTableUser . ".first_name AS author_first_name",
                    $dbTableUser . ".last_name AS author_last_name",
                    $dbTableUser . ".patronymic AS author_patronymic",
                    'comments.content', "comments.created_at",
                ]);

            $parent_name = null;
            if ($task->parent_id !== null) {
                $parent_name = Task::select([
                    "name"
                ])->find($task->parent_id)->name;
            }

            $task->stages = $stages;
            $task->comments = $comments;
            $task->parent_name = $parent_name;
        }

        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request)
    {
        $inputArr = $request->valid;
        unset($inputArr["taskId"]);

        $stages = false;
        if (array_key_exists("stages", $inputArr)) {
            $stages = $inputArr["stages"];
            unset($inputArr["stages"]);
        }

        $responsible_time_spent = false;
        if (array_key_exists("responsible_time_spent", $inputArr)) {
            $responsible_time_spent = $inputArr["responsible_time_spent"];
            unset($inputArr["responsible_time_spent"]);
        }

        if (sizeof($inputArr) !== 0) {
            if ($request->status_id === 5) { // статус = Выполнено
                $inputArr["completed_at"] = now();
                $inputArr["is_completed"] = true;
            }
            Task::where('id', '=', $request->taskId)
                ->update($inputArr);
        }

        if ($responsible_time_spent !== false) {
            Executors::where('task_id', '=', $request->taskId)
                //->where('user_id', '=', $request->responsible_id)
                ->update(['time_spent' => $responsible_time_spent]);
        }

        if ($stages !== false) {
            foreach ($stages as $key => $stage) {
                if (!array_key_exists("id", $stage)) {
                    Stages::create([
                        'task_id' => $request->taskId,
                        'description' => $stage['description'],
                        'is_ready' => $stage['is_ready']
                    ]);
                } else {
                    // Так сделано. Так как поля в stage не валидируются. Могут быть лишние поля, например stage["test"]
                    // Есди сделать один запрос для всех ифов.
                    if (!array_key_exists("description", $stage) && !array_key_exists("is_ready", $stage)) {
                        Stages::where('task_id', '=', $request->taskId)
                            ->where('id', '=', $stage["id"])
                            ->delete();
                    }
                    if (array_key_exists("description", $stage) && array_key_exists("is_ready", $stage)) {
                        Stages::where('task_id', '=', $request->taskId)
                            ->where('id', '=', $stage["id"])
                            ->update([
                                'is_ready' => $stage['is_ready'],
                                'description' => $stage['description']
                            ]);
                    }
                    if (!array_key_exists("description", $stage) && array_key_exists("is_ready", $stage)) {
                        Stages::where('task_id', '=',  $request->taskId)
                            ->where('id', '=', $stage["id"])
                            ->update([
                                'is_ready' => $stage['is_ready']
                            ]);
                    }
                    if (array_key_exists("description", $stage) && !array_key_exists("is_ready", $stage)) {
                        Stages::where('task_id', '=', $request->taskId)
                            ->where('id', '=', $stage["id"])
                            ->update([
                                'description' => $stage['description']
                            ]);
                    }
                }
            }
        }

        return response(["message" => 'Успех'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskDestroyRequest $request)
    {
        Task::where('id', '=', $request->taskId)
            ->delete();

        return response(["message" => 'Успех'], 200);
    }
}
