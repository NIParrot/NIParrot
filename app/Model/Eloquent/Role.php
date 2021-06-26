<?php

namespace EloquentModel;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    protected $fillable = ['name'];
}
