<?php

namespace App\Models\Kaban;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Stages
 *
 * @property int $id
 * @property int $task_id
 * @property string $description
 * @property int $is_ready
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stages query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stages whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stages whereIsReady($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stages whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stages whereUpdatedAt($value)
 */
class Stages extends Model
{
    use HasFactory;

    protected $connection = 'kaban';
    protected $table = 'stages';

    protected $guarded = ['id'];
    public $timestamps = true;

    public function task(): HasOne
    {
        return $this->hasOne(Task::class);
    }
}
