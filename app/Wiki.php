<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    protected $fillable = ['portal_id', 'user_id', 'title', 'body'];
}
