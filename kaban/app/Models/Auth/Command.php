<?php

namespace App\Models\Auth;

use App\Models\Auth\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Command extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'uralapi_team';

    protected $guarded = [ 'id' ];

    public function project() :HasOne
    {
        return $this->hasOne(Project::class, 'id', 'id_project_id');
    }

    public function tutor() :HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_tutor_id');
    }

    public function user2command()
    {
        return $this->hasMany(User2Command::class, 'id_team_id', 'id');
    }
}
