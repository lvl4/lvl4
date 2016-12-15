<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::where('user_id', Auth::user()->id)->get();

        return view('tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
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
            'name' => 'required|max:255',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->user_id = Auth::user()->id;
        $tag->save();

        return redirect()->route('tag.index')->with('message', "$tag->name added successfully.");
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

        if (Auth::user()) {
            if (Auth::user()->id == $tag->user_id) {
                return view('tag.edit', ['tag' => $tag]);
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
        $tag = Tag::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tag.index')->with('message', "$tag->name edited successfully.");
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
        $tag_name = $tag->name;
        $tag->delete();

        return redirect()->route('tag.index')->with('message', "$tag_name deleted successfully.");
    }
}
