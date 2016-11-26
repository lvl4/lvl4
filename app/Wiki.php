<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wiki extends Model
{
    protected $fillable = ['title', 'body', 'stauts', 'user_id'];

    public function decks()
    {
        return $this->hasMany('App\Deck');
    }

    public function tags()
    {
        // $tags = DB::table('wikis_tags')
        //     ->join('tags', 'wikis_tags.tag_id', '=', 'tags.id')
        //     ->join('wikis', 'wikis.id', '=', 'wikis_tags.wiki_id')
        //     ->where('wikis.id', $this->id)
        //     ->select('tags.*')
        //     ->get();
        //     return $tags;
        // 
    }
}
