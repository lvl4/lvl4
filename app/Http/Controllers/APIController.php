<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\UserCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($deck_id)
    {
        // $card = DB::table('users_cards')
        //             ->join('cards', 'users_cards.card_id', '=', 'cards.id')
        //             ->join('decks', 'cards.deck_id', '=', 'decks.id')
        //             ->select('cards.*')
        //             ->where('cards.status', 'published')
        //             ->where('cards.deck_id', $deck_id)
        //             ->where('users_cards.next_time', null)
        //             ->orWhere(DB::raw('DATE(users_cards.next_time)'), '=', strval(date('Y-m-d')))
        //             // ->orderByRaw('RAND()')->take(1)
        //             // ->first();
        //             ->get();
        $card = DB::table('cards')
            ->join('users_cards', 'cards.id', '=', 'users_cards.card_id')
            ->select('cards.*', 'users_cards.factor as factor', 'users_cards.repeated as repeated')
            ->where('cards.deck_id', $deck_id)
            ->where('users_cards.next_time', null)
            ->orWhere(DB::raw('DATE(users_cards.next_time)'), '=', strval(date('Y-m-d')))
            ->where('users_cards.deck_id', $deck_id)
            ->where('cards.status', 'published')
            ->orderByRaw('RAND()')->take(1)
            ->first();
        // $card = DB::select("select cards.* from cards, decks, users_cards where cards.deck_id = $deck_id and  cards.id = users_cards.id and  cards.status = 'published'");

        return json_encode($card);
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
        $card_id = $request->card_id;
        $quality = $request->quality;
        $user_id = $request->user_id;

        $user_card = UserCard::where('card_id', $card_id)
                            ->where('user_id', $user_id)
                            ->first();

        $user_card->last_reviewed = date('Y-m-d H:i:s');

        function calcInterval($repeated, $factor)
        {
            if ($repeated == 1) {
                $interval = 1;
            } elseif ($repeated == 2) {
                $interval = 6;
            } else {
                $interval = ($repeated - 1) * $factor;
            }

            return round($interval);
        }

        function calcEF($factor, $quality)
        {
            $EF = $factor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));

            if ($EF < 1.3) {
                $EF = 1.3;
            } else {
                $EF = $EF;
            }

            return $EF;
        }

        if (!$user_card == null) {
            $factor   = $user_card->factor;
            $repeated = $user_card->repeated;

            $interval = calcInterval($user_card->repeated, $factor);
            $user_card->repeated  = $user_card->repeated + 1;
            $user_card->next_time = date('Y-m-d H:i:s', strtotime("+ $interval days"));

            $EF = calcEF($factor, $quality);

            $user_card->factor = $EF;
            $user_card->save();
        }


        return json_encode('OK!');
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
        //
    }

    public function setActive(Request $request)
    {
        $active = $request->input('active');
        Session::put('active', $active);
    }
}
