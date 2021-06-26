<?php

namespace EloquentModel;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Permission extends Eloquent
{
    protected $fillable = ['name'];
}
