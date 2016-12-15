<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Bank;
use App\UserCard;
use App\Card;
use DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = DB::table('decks')
            ->join('banks', 'decks.id', '=', 'banks.deck_id')
            ->join('users', 'banks.user_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->select('decks.*', 'banks.created_at as bank_created_at')
            ->get();

        return view('bank.index', ['banks' => $banks]);
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
        $deck_id = $request->deck_id;

        $bank = new Bank;
        $bank->user_id = Auth::user()->id;
        $bank->deck_id = $deck_id;
        $bank->save();

        $cards = Card::where('deck_id', $deck_id)->get();

        foreach ($cards as $card) {
            UserCard::create([
               'user_id' => Auth::user()->id,
               'card_id' => $card->id, 
               'deck_id' => $deck_id
            ]);
        }

        return redirect()->back()->with('message', 'Deck has been added to your Bank.');
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
        $user_id = Auth::user()->id;
        $deck_id = $id;

        $bank = Bank::where('user_id', $user_id)->where('deck_id', $deck_id)->first();

        if (Auth::user()->id == $bank->user_id) {
            $bank->delete();

            $user_cards = UserCard::where('deck_id', $deck_id)->where('user_id', $user_id)->get();
            foreach ($user_cards as $card) {
                $card->delete();
            }

            return redirect()->back()->with('message', 'Deck successfully removed from your Bank.');
        }else{
            abort(403);
        }


    }
}
