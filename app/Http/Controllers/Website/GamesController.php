<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use App\Models\Game;
use App\Models\Tournaments;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_games= Game::where('is_active', 1)->where('is_deleted',0)->orderBy('id','DESC')->take(5)->get();
        $games= Game::where('is_active', 1)->where('is_deleted',0)->get();
        $today = date("Y-m-d");
        $upcoming_tournaments = DB::table('tournaments')
               ->join('games', 'tournaments.game_id', '=', 'games.id')
               ->select('tournaments.*', 'games.name as game_name')
               ->where('tournaments.is_active',1)
               ->where('tournaments.is_deleted',0)
               ->where('tournaments.start_date','>',$today)
               ->get();
        return view ('website.game.index',compact('latest_games','games','upcoming_tournaments'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gamedetails($id,$slug)
    {
        $game=Game::find($id);
        $tournaments= Tournaments::where('game_id',$id)->where('is_active', 1)->where('is_deleted',0)->get();
        return view ('website.game.detail',compact('game','tournaments'));
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
}
