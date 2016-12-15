<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['user_id', 'question', 'answer', 'deck_id'];
}
