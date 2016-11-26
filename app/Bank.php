<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['user_id', 'deck_id'];
    
    // public function user()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function decks()
    {
        return $this->hasMany(Deck::class);
    }
}
