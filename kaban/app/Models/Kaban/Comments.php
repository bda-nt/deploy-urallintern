<?php

namespace App\Models\Kaban;

use App\Models\Kaban\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Comments
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments query()
 */
class Comments extends Model
{
    use HasFactory;

    protected $connection = 'kaban';
    protected $table = 'comments';

    protected $guarded = ['id'];
    public $timestamps = true;

    public function task()
    {
        return Task::all();
    }
}
