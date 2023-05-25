<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'uralapi_user';

    protected $guarded  = [ 'id' ];

    public function user2command()
    {
        return $this->hasMany(User2Command::class, 'id_intern_id', 'id');
    }
}
