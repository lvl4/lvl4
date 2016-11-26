<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Deck;
use App\Wiki;
use Auth;
use Illuminate\Http\Request;

class DeckController extends Controller
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
        $name = $request->name;
        $wiki_id = $request->wiki_id;
        $user_id = Auth::user()->id;

        $this->validate($request, [
            'name' => 'required|max:255',
            'wiki_id' => 'required',
        ]);

        $deck = Deck::create([
            'name' => $name,
            'user_id' => $user_id,
            'wiki_id' => $wiki_id
        ]);

        return redirect()->back()->with('message', '"'. $name .'" deck created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deck = Deck::find($id);
        $cards = $deck->cards;

        $inBank = Bank::where('deck_id', $deck->id)->where('user_id', Auth::user()->id)->get();

        if (count($inBank) > 0) {
            $inBank = true;
        }else{
            $inBank = false;
        }

        return view('deck.show', ['deck' => $deck, 'cards' => $cards, 'inBank' => $inBank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deck = Deck::find($id);

        if (Auth::user()->id != $deck->user_id) {
            abort(403);
        }

        $wikis = Wiki::all();

        return view('deck.edit', ['deck' => $deck, 'wikis' => $wikis]);
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

        $name = $request->name;
        $wiki = $request->wiki;
        $status = $request->status;

        $deck = Deck::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'wiki' => 'required',
            'status' => 'required'
        ]);

        $deck->name = $name;
        $deck->wiki_id = $wiki;
        $deck->status = $status;
        $deck->save();

        return redirect()->back()->with('message', 'Deck updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deck = Deck::find($id);
        $deck->delete();

        return redirect()->route('account.show', Auth::user()->id)->with('message', 'Deck deleted successfuly.');

    }
}
