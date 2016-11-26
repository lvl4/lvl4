<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Deck;
use App\Tag;
use App\User;
use App\Wiki;
use DB;
use Illuminate\Http\Request;

class AccountController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = User::find($id);

        $banks = DB::table('decks')
                    ->join('banks', 'decks.id', '=', 'banks.deck_id')
                    ->join('users', 'banks.user_id', '=', 'users.id')
                    ->where('users.id', $user->id)
                    ->select('decks.*', 'banks.created_at as bank_created_at')
                    ->get();

        $tags = Tag::orderBy('name', 'ASC')->get();

        $my_wikis = Wiki::where('user_id', $user->id)->orderBy('title', 'ASC')->get();

        $wikis = Wiki::orderBy('title', 'ASC')->get();

        $decks = Deck::where('user_id', $user->id)->orderBy('name', 'ASC')->get();

        return view('account.show', [
            'user' => $user,
            'banks' => $banks,
            'tags' => $tags,
            'wikis' => $wikis,
            'decks' => $decks,
            'my_wikis' => $my_wikis,
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
}
