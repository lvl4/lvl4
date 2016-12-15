<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    protected $table = 'users_cards';

    protected $fillable = ['user_id', 'deck_id', 'card_id'];
}
