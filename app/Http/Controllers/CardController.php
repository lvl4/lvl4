<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Card;
use App\Deck;
use App\UserCard;
use Auth;
use Illuminate\Http\Request;

class CardController extends Controller
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

    public function view($id)
    {   
        $deck = Deck::find($id);
        $cards = Card::where('deck_id', $deck->id)->get();

        return view('card.view', ['deck' => $deck, 'cards' => $cards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $decks = Deck::where('user_id', Auth::user()->id)->get();
        return view('card.create', ['decks' => $decks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = $request->question;
        $deck_id = $request->deck_id;
        $answer = $request->answer;
        $status = $request->status;
        $user_id = Auth::user()->id;

        $this->validate($request, [
            'question' => 'required|max:255',
            'answer' => 'required|max:255',
            'deck_id' => 'required',
            'status' => 'required',
        ]);

        $card = Card::create([
            'question' => $question,
            'answer' => $answer,
            'deck_id' => $deck_id,
            'status' => $status,
            'user_id' => $user_id
        ]);

        $banks = Bank::where('deck_id', $deck_id)->get();

        foreach ($banks as $bank) {
            $user_card = new UserCard;
            $user_card->user_id = $bank->user_id;
            $user_card->card_id = $card->id;
            $user_card->deck_id = $deck_id;
            $user_card->save();
        }

        return redirect()->back()->with('message', 'Card created succcessfuly.');
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
        return view('card.show', ['deck' => $deck]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);

        if (Auth::user()->id != $card->user_id) {
            abort(403);
        }

        $decks = Deck::where('user_id', Auth::user()->id)->get();

        return view('card.edit', ['card' => $card, 'decks' => $decks]);

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
        $card = Card::find($id);

        $question = $request->question;
        $answer = $request->answer;
        $status = $request->status;
        $deck_id = $request->deck_id;

        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
            'deck_id' => 'required',
        ]);

        $card->question = $question;
        $card->answer = $answer;
        $card->status = $status;
        $card->deck_id = $deck_id;
        $card->save();

        return redirect()->back()->with('message', 'Card updated successfuly.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        $deck_id = $card->deck_id;

        $users_cards = UserCard::where('card_id', $card->id)->get();

        foreach ($users_cards as $user_card) {
            $user_card->delete();
        }

        $card->delete();

        return redirect()->route('card.view', $deck_id)->with('message', 'Card deleted successfuly.');

    }
}
