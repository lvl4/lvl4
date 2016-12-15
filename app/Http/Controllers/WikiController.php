<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wiki;
use App\Portal;
use App\Deck;
use App\Tag;
use App\WikiTag;
use Auth;
use DB;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tags = Tag::all();
        $portal = Portal::find($id);

        return view('wiki.create', [
            'tags' => $tags,
            'portal' => $portal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id; 
        $portal_id = $request->portal_id;

        $this->validate($request, [
            'title' => 'required|max:255',
            'tags' => 'required',
            'status' => 'required',
            'body' => 'required',
        ]);

        $wiki = new Wiki;
        $wiki->title = $request->title;
        $wiki->status = $request->status;
        $wiki->body = $request->body;
        $wiki->portal_id = $request->portal_id;
        $wiki->user_id = $request->user_id;
        $wiki->save();

        foreach ($request->tags as $tag) {
            $wiki_tag = new WikiTag;
            $wiki_tag->wiki_id = $wiki->id;
            $wiki_tag->tag_id = $tag;
            $wiki_tag->save();
        }

        return redirect()->route('portal.show', $portal_id)->with('message', "$wiki->title created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wiki = Wiki::find($id);
        $portal = Portal::find($wiki->portal_id);
        $decks = Deck::where('portal_id', $portal->id)->get();
        $tagIDs = WikiTag::where('wiki_id', $wiki->id)->pluck('tag_id');
        
        $tags = [];

        foreach ($tagIDs as $tagID) {
            $tag = Tag::find($tagID);
            $tags[] = $tag;
        }
      

        return view('wiki.show', [
            'wiki' => $wiki,
            'portal' => $portal,
            'decks' => $decks,
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wiki = Wiki::find($id);

        if (Auth::user()) {
            if (Auth::user()->id == $wiki->user_id) {
                $tags = Tag::all();
                $selectedTags = WikiTag::where('wiki_id', $wiki->id)->pluck('tag_id')->toArray();
                $portal = Portal::find($wiki->portal_id);

                return view('wiki.edit', [
                    'wiki' => $wiki,
                    'tags' => $tags,
                    'selectedTags' => $selectedTags,
                    'portal' => $portal
                ]);
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }


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
        $wiki = Wiki::find($id);

        $this->validate($request, [
            'title' => 'required|max:255',
            'tags' => 'required',
            'status' => 'required',
            'body' => 'required',
        ]);

        $previousTags = WikiTag::where('wiki_id', $wiki->id)->get();

        foreach ($previousTags as $previousTag) {
            $previousTag->delete();
        }

        $wiki->title = $request->title;
        $wiki->status = $request->status;
        $wiki->body = $request->body;
        $wiki->save();

        foreach ($request->tags as $tag) {
            $wiki_tag = new WikiTag;
            $wiki_tag->wiki_id = $wiki->id;
            $wiki_tag->tag_id = $tag;
            $wiki_tag->save();
        }

        return redirect()->route('wiki.show', $wiki->id)->with('message', "$wiki->title edited successfully.");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wiki = Wiki::find($id);
        $portal_id = $wiki->portal_id;
        $wiki->delete();

        return redirect()->route('portal.show', $portal_id)->with('message', 'Wiki deleted successfully,');
    }

    public function yours()
    {
        $wikis = Wiki::where('user_id', Auth::user()->id)->get();

        $wiki_tags = [];

        foreach ($wikis as $wiki) {
            $wiki_tags[$wiki->id] = [];
        }

        foreach ($wiki_tags as $wiki_id => $array) {

            $found_tags = DB::table('tags')
                ->join('wikis_tags', 'wikis_tags.tag_id', 'tags.id')
                ->join('wikis', 'wikis.id', 'wikis_tags.wiki_id')
                ->select('tags.*')
                ->where('wikis_tags.wiki_id', $wiki_id)
                ->get();

            if (count($found_tags) > 0) {
                foreach ($found_tags as $found_tag) {
                    $wiki_tags[$wiki_id][] = $found_tag->name;
                }
            }
        }

        return view('wiki.yours', [
            'wikis' => $wikis,
            'wiki_tags' => $wiki_tags
        ]);
    }
}
