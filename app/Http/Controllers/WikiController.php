<?php

namespace App\Http\Controllers;

use App\Deck;
use App\Tag;
use App\Wiki;
use App\WikiTag;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $wikis = Wiki::where('status', 'published')->paginate(10);
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

        // dd($wikiTags);
        // exit;
        $user_id = Auth::user()->id;

            $banks = DB::table('decks')
                        ->join('banks', 'decks.id', '=', 'banks.deck_id')
                        ->join('users', 'banks.user_id', '=', 'users.id')
                        ->where('users.id', $user_id)
                        ->select('decks.*')
                        ->take(6)
                        ->get();

            $bank_count = DB::table('decks')
                        ->join('banks', 'decks.id', '=', 'banks.deck_id')
                        ->join('users', 'banks.user_id', '=', 'users.id')
                        ->where('users.id', $user_id)
                        ->select('decks.*')
                        ->get();

        $bank_count = count($bank_count);

        return view('wiki.index', ['wikis' => $wikis, 'banks' => $banks, 'bank_count' => $bank_count, 'wikiTags' => $wikiTags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('wiki.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $status = $request->status;
        $tags = $request->tags;
        $body = $request->body;
        $tags = explode(",", $tags);

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required',
            'tags' => 'required',
        ]);

        $wiki = Wiki::create([
            'title' => $title,
            'body' => $body,
            'status' => $status,
            'user_id' => Auth::user()->id
        ]);

        foreach ($tags as $tag) {
            $wiki_tag = new WikiTag;
            $wiki_tag->wiki_id = $wiki->id;
            $wiki_tag->tag_id = $tag;
            $wiki_tag->save();
        }


        return redirect()->route('account.show', Auth::user()->id)->with('message', '"'. $wiki->title .'" has been created.');
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
        $decks = Deck::where('wiki_id', $wiki->id)->where('status', 'published')->get();
        // $decks = $wiki->decks;
        return view('wiki.show', [
            'wiki' => $wiki,
            'decks' => $decks,
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

        if (Auth::user()->id != $wiki->user_id) {
            abort(403);
        }

        $tags = Tag::all();
        $my_tags = DB::table('wikis_tags')
                    ->join('tags', 'wikis_tags.tag_id', '=', 'tags.id')
                    ->where('wikis_tags.wiki_id', '=', $wiki->id)
                    ->select('wikis_tags.*')
                    ->get();

        $selected = [];

        foreach ($my_tags as $tag) {
            $selected[] = $tag->tag_id;
        }

        return view('wiki.edit', ['wiki' => $wiki, 'tags' => $tags, 'selected' => $selected]);
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

        $title = $request->title;
        $body = $request->body;
        $tags = $request->tags;
        $tags = explode(",", $tags);
        $status = $request->status;

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'tags' => 'required',
            'status' => 'required',
        ]);

        $wiki->title = $title;
        $wiki->body = $body;
        $wiki->status = $status;
        $wiki->save();

        $previous_tags = WikiTag::where('wiki_id', $wiki->id)->get();

        foreach ($previous_tags as $tag) {
            $tag->delete();
        }

        foreach ($tags as $tag) {
            $wiki_tag = new WikiTag;
            $wiki_tag->wiki_id = $wiki->id;
            $wiki_tag->tag_id = $tag;
            $wiki_tag->save();
        }

        return redirect()->back()->with('message', '"'. $wiki->title .'" has been updated succesfully.');
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
        $title = $wiki->title;

        $wiki_tags  = WikiTag::where('wiki_id', $wiki->id)->get();
        foreach ($wiki_tags as $wiki_tag) {
            $wiki_tag->delete();
        }

        $wiki->delete();

        return redirect()->route('account.show', Auth::user()->id)->with('message', '"'. $title .'" has been deleted.');
    }
}
