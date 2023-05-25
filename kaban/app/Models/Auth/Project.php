<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'uralapi_project';

    protected $guarded = [ 'id' ];
}
