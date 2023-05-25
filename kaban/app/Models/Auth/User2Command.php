<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User2Command extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'uralapi_internteam';

    protected $guarded = [ 'id' ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_intern_id');
    }

    public function command()
    {
        return $this->hasOne(Command::class, 'id', 'id_team_id');
    }
}
