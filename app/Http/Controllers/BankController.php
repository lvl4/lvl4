<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Deck;
use App\UserCard;
use Auth;
use Illuminate\Http\Request;

class BankController extends Controller
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
        $user_id = $request->user_id;
        $deck_id = $request->deck_id;
        $bank = Bank::create([
            'user_id' => $user_id,
            'deck_id' => $deck_id,
        ]);

        $cards = Deck::find($deck_id)->cards;
        // dd($cards);
        foreach ($cards as $card) {
            UserCard::create([
                'user_id' => $user_id,
                'card_id' => $card->id,
                'deck_id' => $deck_id,
            ]);
        }

        $request->session()->flash('message-success', 'You can now start quizing yourself below!');
        return redirect()->back();
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
        $bank = Bank::where('deck_id',$id)->where('user_id', Auth::user()->id);

        $user_cards = UserCard::where('deck_id', $id)->where('user_id', Auth::user()->id)->get();
        foreach ($user_cards as $card) {
            $card->delete();
        }
        $bank->delete();
        return redirect()->back()->with('message', 'Deck removed from Bank successfuly.');
    }
}
