<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Card;
use App\Deck;
use App\UserCard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $deck = Deck::find($id);
        return view('card.create', ['deck' => $deck]);
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

        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        $card = Card::create([
            'deck_id' => $deck_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'user_id' => $request->user_id
        ]);

        $banks = Bank::where('deck_id', $deck_id)->get();

        foreach ($banks as $bank) {
            $user_card = new UserCard;
            $user_card->user_id = $bank->user_id;
            $user_card->card_id = $card->id;
            $user_card->deck_id = $deck_id;
            $user_card->save();
        }

        return redirect()->route('deck.show', $deck_id)->with('message', 'Card added successfully.');

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
        $card = Card::find($id);
        $deck = Deck::find($card->deck_id);

        return view('card.edit', [
            'card' => $card,
            'deck' => $deck
        ]);
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

        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        $card->question = $request->question;
        $card->answer = $request->question;
        $card->user_id = $request->user_id;
        $card->save();

        return redirect()->route('deck.show', $request->deck_id)->with('message', 'Card edited successfully.');
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
            
        $deck_id  = $card->deck_id;

        $card->delete();


        return redirect()->route('deck.show', $deck_id)->with('message', 'Card deleted successfully.');
    }

    public function import(Request $request, $id)
    {   
        $deck_id = $id;
        $user_id = Auth::user()->id;

        $this->validate($request, [
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $fileID = date('ymdhis');


        if ($file->isValid()) {
            $path = $file->storeAs('public/excel', $fileID.'.xlsx');

            $results = Excel::load("public/storage/excel/$fileID.xlsx")->get();
            foreach ($results as $row) {
                $card = Card::create([
                    'question' => nl2br($row->question),
                    'answer' => nl2br($row->answer),
                    'user_id' => $user_id,
                    'deck_id' => $deck_id
                ]);

                $banks = Bank::where('deck_id', $deck_id)->get();

                foreach ($banks as $bank) {
                    $user_card = new UserCard;
                    $user_card->user_id = $bank->user_id;
                    $user_card->card_id = $card->id;
                    $user_card->deck_id = $deck_id;
                    $user_card->save();
                }
            }
        Storage::delete("public/excel/$fileID.xlsx");

            return redirect()->back()->with('message', 'Excel import completed successfully.');
        }else{
            return redirect()->back()->with('error', 'There was an error uploading the document.');
        }
    }
}
