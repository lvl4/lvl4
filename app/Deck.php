<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $fillable = ['user_id', 'portal_id', 'name'];
}
