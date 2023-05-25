<?php

namespace App\Models\Kaban;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Roles
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Roles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Roles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Roles query()
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Roles whereUpdatedAt($value)
 */
class Roles extends Model
{
    use HasFactory;

    protected $connection = 'kaban';
    protected $table = 'roles';
    protected $guarded = ['id'];
    protected $fillable = [
        'name'
    ];
    public $timestamps = true;

    public function executors(): HasMany
    {
        return $this->hasMany(Executors::class);
    }
}
