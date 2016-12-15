<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deck;
use App\Card;
use App\Wiki;
use App\Portal;
use Auth;
use App\Bank;

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
    public function create($id)
    {
        $portal = Portal::find($id);

        return view('deck.create', ['portal' => $portal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $portal_id = $request->portal_id;
        $user_id = $request->user_id;


        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $deck = Deck::create([
            'user_id' => $user_id,
            'portal_id' => $portal_id,
            'name' => $request->name
        ]);

        return redirect()->route('deck.show', $deck->id)->with('message', "$deck->name created successfully. You can add cards below.");
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
        $portal = Portal::find($deck->portal_id);
        $cards = Card::where('deck_id', $deck->id)->get();

        $in_deck = false;

        $bank = Bank::where('user_id', Auth::user()->id)->where('deck_id', $deck->id)->get();

        if (count($bank) > 0) {
            $in_deck = true;
        }

        return view('deck.show', [
            'deck' => $deck,
            'cards' => $cards,
            'portal' => $portal,
            'in_deck' => $in_deck
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
        $deck = Deck::find($id);

        if (Auth::user()) {
            if (Auth::user()->id == $deck->user_id) {
                $portal = Portal::find($deck->portal_id);

                return view('deck.edit', [
                    'deck' => $deck,
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
        $deck = Deck::find($id);

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $deck->name = $request->name;
        $deck->save();

        return redirect()->route('deck.show', $deck->id)->with('message', "$deck->name edited successfully.");

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
        $deck_name = $deck->name;
        $portal_id = $deck->portal_id;
        $deck->delete();

        return redirect()->route('portal.show', $portal_id)->with('message', "$deck_name deleted successfully.");
    }

    public function yours()
    {
        $decks = Deck::where('user_id', Auth::user()->id)->get();

        return view('deck.yours', ['decks' => $decks]);
    }
}
