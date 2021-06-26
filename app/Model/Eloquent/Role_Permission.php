<?php

namespace EloquentModel;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role_Permission extends Eloquent
{
    protected $fillable = ['roles_id', 'permissions_id'];
}
