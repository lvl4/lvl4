<?php

namespace App\Http\Controllers;

use App\Tag;
use App\WikiTag;
use Auth;
use Illuminate\Http\Request;

class TagController extends Controller
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
        $this->validate($request, [
            'name' => 'required|unique:tags|max:255',
        ]);

        $name = $request->input('name');
        $tag = Tag::create([
            'name' => $name    
        ]);

        return redirect()->back()->with('message', '"'. $name .'" tag created successfully.');
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
        $tag = Tag::find($id);  

        return view('tag.edit', ['tag' => $tag]);
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
        $tag = Tag::find($id);
        $name = $request->name;

        $this->validate($request, [
            'name' => 'required|unique:tags|max:255',
        ]);

        $tag->name = $name;
        $tag->save();

        return redirect()->back()->with('message', 'Tag updated successfuly.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        $wikis_tags = WikiTag::where('tag_id', $tag->id)->get();

        foreach ($wikis_tags as $wiki_tag) {
            $wiki_tag->delete();
        }

        $tag->delete();

        return redirect()->route('account.show', Auth::user()->id)->with('message', 'Tag deleted successfuly.');
    }
}
