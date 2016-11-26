<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_term = $request->search_term;

        $wikis = DB::table('wikis')
                ->join('users', 'wikis.user_id', '=', 'users.id')
                ->select('wikis.*', 'users.username as user_username', 'users.id as user_id')
                ->where('status', 'published')
                ->where('title', 'like', "%$search_term%")
                ->get();

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

        return view('search.index', ['wikis' => $wikis, 'wikiTags' => $wikiTags, 'search_term' => $search_term]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
