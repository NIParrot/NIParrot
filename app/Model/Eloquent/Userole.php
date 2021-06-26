<?php

namespace EloquentModel;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Userole extends Eloquent
{
    protected $fillable = ['roles_id', 'user_id', 'modeltype'];
}
