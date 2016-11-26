<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wikis = DB::table('wikis')
                ->join('users', 'wikis.user_id', '=', 'users.id')
                ->select('wikis.*', 'users.username as user_username', 'users.id as user_id')
                ->where('wikis.status', 'published')
                ->orderBy('wikis.created_at', 'DESC')
                // ->paginate(10);
                ->paginate(15);

        $wikiTags = [];

        foreach ($wikis as $wiki) {
            // $wiki = Wiki::find($wiki->id);
            $wikiTags[] = ['id' => $wiki->id];
        } 

        $count = 0;
        foreach ($wikiTags as $wikiID) {
            $found_tags = DB::table('tags')
                ->join('wikis_tags', 'wikis_tags.tag_id', 'tags.id')
                ->join('wikis', 'wikis.id', 'wikis_tags.wiki_id')
                ->select('tags.*')
                ->where('wikis_tags.wiki_id', $wikiID)
                ->get();
            $arr_tags = [];
            foreach ($found_tags as $tag) {
                $arr_tags[] = $tag->name;
            }
            $wikiTags[$count]['tags'] = $arr_tags;
            $count++;
        }

        return view('home.index', ['wikis' => $wikis, 'wikiTags' => $wikiTags]);
        
    }
}
