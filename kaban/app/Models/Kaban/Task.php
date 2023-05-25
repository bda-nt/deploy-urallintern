<?php

namespace App\Models\Kaban;

use App\Models\Auth\Command;
use App\Models\Auth\Project;
use App\Models\Kaban\Stages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $project_id
 * @property int $team_id
 * @property string $name
 * @property int $is_on_kanban
 * @property int $is_completed
 * @property int $status_id
 * @property string $planned_start_date
 * @property string $planned_final_date
 * @property string|null $deadline
 * @property string|null $completed_at
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereIsOnKanban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePlannedFinalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePlannedStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 */
class Task extends Model
{
    use HasFactory;

    protected $connection = 'kaban';
    protected $table = 'tasks';
    protected $guarded = ['id'];

    /**
     * TODO: CHANGE WHEN AUTH DATABASE CREATED
     *
     * @param int $id
     * @return String
     */
    public function team(int $id): HasOne
    {
        return $this->hasOne(Command::class, 'id', 'team_id');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function parents(int $id): \Illuminate\Database\Eloquent\Builder|Task
    {
        return Task::whereId($id);
    }

    public function stages()
    {
        return $this->hasMany(Stages::class, 'task_id', 'id');
    }
}
