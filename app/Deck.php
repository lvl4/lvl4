<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $fillable = ['name', 'user_id', 'wiki_id'];

    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
