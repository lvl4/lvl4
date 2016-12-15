<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portal;
use App\Wiki;
use App\Deck;
use App\Document;
use Auth;

class PortalController extends Controller
{
    public function showall()
    {   
        $portals = Portal::paginate(10);
        return view('portal.index', ['portals' => $portals]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portals = Portal::paginate(10);

        return view('portal.index', ['portals' => $portals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portal.create');
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

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $portal = Portal::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user_id
        ]);

        return redirect()->route('portal.show', $portal->id)->with('message', "$portal->name created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portal = Portal::find($id);
        $wikis = Wiki::where('portal_id', $portal->id)->where('status', 'published')->get();
        $decks = Deck::where('portal_id', $portal->id)->get();
        $documents = Document::where('portal_id', $portal->id)->get();
        
        return view('portal.show', [
            'portal' => $portal,
            'wikis' => $wikis,
            'decks' => $decks,
            'documents' => $documents
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
        $portal = Portal::find($id);

        if (Auth::user()) {
            if (Auth::user()->id == $portal->user_id) {
                return view('portal.edit', ['portal' => $portal]);
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
        $portal = Portal::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $portal->name = $request->name;
        $portal->description = $request->description;
        $portal->save();

        return redirect()->route('portal.show', $portal->id)->with('message', 'Portal edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portal = Portal::find($id);
        $portal_name = $portal->name;
        $portal->delete();

        return redirect()->route('dashboard.index')->with('message', "$portal_name deleted successfully.");
    }

    public function search(Request $request)
    {   
        $search_term = $request->q;

        $portals = Portal::where('name', 'LIKE', "%$search_term%")->get();

        return view('portal.search', [
            'portals' => $portals,
            'search_term' => $search_term
        ]);
    }

    public function yours()
    {
        $portals = Portal::where('user_id', Auth::user()->id)->get();

        return view('portal.yours',['portals' => $portals]);
    }
}
