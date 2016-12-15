<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    protected $fillable = ['user_id', 'name', 'description'];
}
