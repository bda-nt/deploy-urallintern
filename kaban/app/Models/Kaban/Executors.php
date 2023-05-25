<?php

namespace App\Models\Kaban;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Executors
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property int $role_id
 * @property string|null $time_spent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Executors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Executors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Executors query()
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereTimeSpent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Executors whereUserId($value)
 */
class Executors extends Model
{
    use HasFactory;

    protected $connection = 'kaban';
    protected $table = 'executors';

    protected $guarded = ['id'];
    public $timestamps = true;

    public function role()
    {
        return $this->hasOne(Roles::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(\App\Models\Auth\User::class, 'id', 'user_id');
    }

    public function task()
    {
        return $this->hasOne(Task::class);
    }
}
