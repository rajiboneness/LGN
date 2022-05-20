<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Gamer;
use App\Models\Gamer_tournament_schedule;
use App\Models\Team_tournament_schedule;
use App\Models\TournamentRoomSlot;
use App\Models\Tournaments;
use Auth;
use DB;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = (isset($_GET['date']) && $_GET['date'] != '') ? $_GET['date'] : date("Y-m-d");
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';

        $tournaments = array();
        if ($game_id != '') {
//            $tournamentDatas = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->where('game_id', $game_id)->orderby('id', 'desc')->get();
            $tournamentDatas = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
//                ->where('partner', "lgn")
                ->where('reg_start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->where('game_id', $game_id)
                ->orderby('id', 'desc')
                ->get();

            // echo "query : ".$tournamentDatas->toSql();
            // die("xyz");
        } else {
//            $tournamentDatas = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->orderby('id', 'desc')->get();
            $tournamentDatas = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
//                ->where('partner', "lgn")
                ->where('reg_start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->orderby('id', 'desc')
                ->get();
        }

        foreach ($tournamentDatas as $tournament) {
            $tournament_id = $tournament->id;
            $tournament_type = $tournament->user_type;

            if ($tournament_type == '1') {
                $gamerplayerjoined = DB::select(DB::raw("SELECT COUNT(*)as count FROM `gamers_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));

                if (count($gamerplayerjoined) > 0) {
                    $tournament->player_joined = $gamerplayerjoined[0]->count;
                } else {
                    $tournament->player_joined = 0;
                }
            } else {
                $teamsplayerjoined = DB::select(DB::raw("SELECT COUNT(*) as count FROM `teams_tournaments` where tournament_id='$tournament_id' and is_deleted=0"));

                if (count($teamsplayerjoined) > 0) {
                    $tournament->player_joined = $teamsplayerjoined[0]->count;
                } else {
                    $tournament->player_joined = 0;
                }
            }

            array_push($tournaments, $tournament);
        }

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('website.tournament.index', compact('tournaments', 'games'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        $game_id = (isset($_GET['game_id']) && $_GET['game_id'] != '') ? $_GET['game_id'] : '';

        $tournaments = array();
        if ($game_id != '') {
            $tournaments = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
//                ->where('partner', "lgn")
                ->where('stop_joining', 1)
                ->where('game_id', $game_id)
                ->orderby('id', 'desc')
                ->paginate(16);
        } else {
            $tournaments = Tournaments::where('is_active', 1)
                ->where('is_deleted', 0)
//                ->where('partner', "lgn")
                ->where('stop_joining', 1)
                ->orderby('id', 'desc')
                ->paginate(16);
        }

        $tournaments_player_joined = array();

        foreach ($tournaments as $tournament) {
            $tournament_id = $tournament->id;
            $tournament_type = $tournament->user_type;

            if ($tournament_type == '1') {
                $joined_qry = DB::select(DB::raw("SELECT COUNT(id) as count FROM `gamers_tournaments` where tournament_id='$tournament_id'"));
            } else {
                $joined_qry = DB::select(DB::raw("SELECT COUNT(id) as count FROM `teams_tournaments` where tournament_id='$tournament_id'"));
            }

            if (count($joined_qry) > 0) {
                $tournaments_player_joined[$tournament_id] = $joined_qry[0]->count;
            } else {
                $tournaments_player_joined[$tournament_id] = "?";
            }
        }

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('website.tournament.complete', compact('tournaments', 'games', 'tournaments_player_joined'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id, $slug)
    {
        $tour_id = $id;
        $stage = Gamer_tournament_schedule::where('tournament_id', $id)->orderBy('stage', 'desc')->take(1)->get();
        $tournaments = Tournaments::find($id);
        $tournamentspaid = Tournaments::where(['id' => $id, 'is_free' => '0'])->first();
        $leaderboard = DB::table('gamers_tournaments')
            ->select('gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name', 'gamers_tournaments.tournament_id', DB::raw("SUM(gamers_tournaments.point) as user_point"))
            ->join('tournaments', 'gamers_tournaments.tournament_id', '=', 'tournaments.id')
            ->join('games', 'games.id', '=', 'tournaments.game_id')
            ->join('gamers', 'gamers.id', '=', 'gamers_tournaments.user_id')
            ->join('countries', 'countries.id', '=', 'gamers.country_id')
            ->where('tournaments.status', '=', '1')
            ->where('gamers_tournaments.tournament_id', $tour_id)
            ->where('gamers_tournaments.is_deleted', 0)
            ->groupBy('gamers_tournaments.user_id', 'gamers.fname', 'gamers.lname', 'countries.name',
                'gamers_tournaments.tournament_id')
            ->orderBy('user_point', 'desc')
            ->get()
            ->toArray();

        $teamleaderboard = DB::table('teams_tournaments')
            ->select('teams_tournaments.team_id', 'teams.team_name', 'teams_tournaments.tournament_id', DB::raw("SUM(teams_tournaments.point) as user_point"))
            ->join('tournaments', 'teams_tournaments.tournament_id', '=', 'tournaments.id')
            ->join('games', 'games.id', '=', 'tournaments.game_id')
            ->join('teams', 'teams.id', '=', 'teams_tournaments.team_id')
            ->where('tournaments.status', '=', '1')
            ->where('teams_tournaments.tournament_id', $tour_id)
            ->where('teams_tournaments.is_deleted', 0)
            ->groupBy('teams_tournaments.team_id', 'teams.team_name',
                'teams_tournaments.tournament_id')
            ->orderBy('user_point', 'desc')
            ->get()
            ->toArray();

        if (Auth::guard('gamer')->check()) {
            $authgamer_id = Auth::guard('gamer')->user()->id;
        } else {
            $authgamer_id = null;
        }

        $teamplayers = DB::table('team_players')
            ->select('team_players.*', 'team_players.id as tpid', 'gamers.id as gamer_id', 'teams.id as team_id')
            ->leftjoin('teams', 'team_players.team_id', 'teams.id')
            ->leftjoin('gamers', 'teams.gamer_id', 'gamers.id')
            ->where('team_players.is_deleted', 0)
            ->where('gamers.id', $authgamer_id)
            ->get();

        if ($tournaments->user_type == 1) {
            $playerjoined = DB::select(DB::raw("SELECT COUNT(*) tournament_id FROM `gamers_tournaments` WHERE `tournament_id`=$tour_id and is_deleted=0"));
        } else {
            $playerjoined = DB::select(DB::raw("SELECT COUNT(*) tournament_id FROM `teams_tournaments` WHERE `tournament_id`=$tour_id and is_deleted=0"));
        }
        if ($tournaments->tournament_type == 1) {
            if ($tournaments->user_type == 1) {
                $winner = TournamentRoomSlot::where('tournament_room_slots.tournament_id', $id)
                    ->where('tournament_room_slots.winner', '!=', 0)
                    ->SELECT('gamers.fname as name', 'tournament_room_slots.room_code')
                    ->leftjoin('gamers', 'gamers.id', 'tournament_room_slots.winner')
                    ->get();

                $count = $winner->count();
                if ($count >= 1) {
                    $winner = $winner;
                } else {
                    $winner = '';
                }
            } elseif ($tournaments->user_type == 2) {

                $winner = TournamentRoomSlot::where('tournament_room_slots.tournament_id', $id)
                    ->where('tournament_room_slots.winner', '!=', 0)
                    ->SELECT('teams.team_name as name', 'tournament_room_slots.room_code')
                    ->leftjoin('teams', 'teams.id', 'tournament_room_slots.winner')
                    ->get();
                $count = $winner->count();
                if ($count >= 1) {
                    $winner = $winner;
                } else {
                    $winner = '';
                }
            }
        } elseif ($tournaments->tournament_type == 2) {
            if ($tournaments->user_type == 1) {
                $stage = Gamer_tournament_schedule::where('tournament_id', $id)->orderBy('stage', 'desc')->get();
                if (count($stage) > 0) {
                    $winner = Gamer_tournament_schedule::where('tournament_id', $id)
                        ->select('gamers.fname as name')
                        ->join('gamers', 'gamers.id', 'gamer_tournament_schedules.winner')
                        ->where('gamer_tournament_schedules.stage', $stage[0]->stage)
                        ->get();
                    $count = $winner->count();
                    if ($count == 1) {
                        $winner = $winner;
                    } else {
                        $winner = '';
                    }
                } else {
                    $winner = '';
                }

            } elseif ($tournaments->user_type == 2) {
                $stage = Team_tournament_schedule::where('tournament_id', $id)->orderBy('stage', 'desc')->get();
                if (count($stage) > 0) {
                    $winner = Team_tournament_schedule::where('tournament_id', $id)
                        ->select('teams.team_name as name')
                        ->join('teams', 'teams.id', 'team_tournament_schedules.winner')
                        ->where('team_tournament_schedules.stage', $stage[0]->stage)
                        ->get();

                    $count = $winner->count();
                    if ($count == 1) {
                        $winner = $winner;
                    } else {
                        $winner = '';
                    }
                } else {
                    $winner = '';
                }
            }
        }

        $psnumber = rtrim($tournaments->ps_number, ',');
        $platform = DB::select(DB::raw("SELECT * FROM `platforms` WHERE `id` in ($psnumber); "));
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        if ($tournaments->is_free == 1) {
            return view('website.tournament.detail', compact('games', 'teamleaderboard',
                'tournaments', 'platform', 'leaderboard', 'playerjoined', 'teamplayers', 'winner'));
        } else {

            return view('website.tournament.paiddetail', compact('games', 'teamleaderboard',
                'tournamentspaid', 'platform', 'leaderboard', 'playerjoined', 'teamplayers', 'winner'));
        }

    }

    public function tournamentSorting($id, $slug)
    {
        $tournaments = Tournaments::where('is_active', 1)->where('is_deleted', 0)->where('game_id', $id)->orderby('id', 'desc')->get();
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.tournament.index', compact('tournaments', 'games'));
    }


    public function completetournamentSorting($id, $slug)
    {
        $tournaments = Tournaments::where(['is_active' => 1, 'stop_joining' => 1])
            ->where('is_deleted', 0)
            ->where('game_id', $id)
            ->orderby('id', 'desc')
            ->get();
        $games = Game::where('is_active', 1)
            ->where('is_deleted', 0)
            ->get();
        return view('website.tournament.complete', compact('tournaments', 'games'));
    }

    public function mygame($id)
    {
        $gamertype = Gamer::find($id);
        $gamertype = $gamertype->gamer_type;
        if ($gamertype == 1) {
            $tournaments = Gamer::where('gamers.id', $id)
                ->join('gamers_tournaments', 'gamers_tournaments.user_id', '=', 'gamers.id')
                ->join('tournaments', 'gamers_tournaments.tournament_id', '=', 'tournaments.id')
                ->select('tournaments.*')
                ->where('tournaments.is_active', 1)->where('tournaments.is_deleted', 0)
                ->get();
        } else {
            $tournaments = Gamer::where('gamers.id', $id)
                ->leftjoin('teams', 'teams.gamer_id', 'gamers.id')
                ->leftjoin('teams_tournaments', 'teams_tournaments.team_id', '=', 'teams.id')
                ->leftjoin('tournaments', 'teams_tournaments.tournament_id', '=', 'tournaments.id')
                ->select('tournaments.*')
                ->where('tournaments.is_active', 1)->where('tournaments.is_deleted', 0)
                ->get();
        }

        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.tournament.mytournament',
            compact('tournaments', 'games'));
    }


//         public function fixture($id){
//             $tournaments= Tournaments::find($id);
//            $stage1=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
//             tournaments.name as tname,gamer_tournament_points.*,
//             gt1.in_game_id as player1_psn,gt2.in_game_id as player2_psn
//          from gamer_tournament_schedules left join gamers as g1
//          on (gamer_tournament_schedules.player1 = g1.id)
//          left join gamers as g2
//          on (gamer_tournament_schedules.player2 = g2.id) 
//          left join tournaments
//          on (gamer_tournament_schedules.tournament_id = tournaments.id)
//          left join gamer_tournament_points
//          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
//          left join gamers_tournaments as gt1
//          on (gt1.user_id=gamer_tournament_schedules.player1)
//          left join gamers_tournaments as gt2
//          on (gt2.user_id=gamer_tournament_schedules.player2)
//          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 1 "));
//             $count1=count($stage1); 

//             $stage2=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
//             tournaments.name as tname,gamer_tournament_points.*
//          from gamer_tournament_schedules left join gamers as g1
//          on (gamer_tournament_schedules.player1 = g1.id)
//          left join gamers as g2
//          on (gamer_tournament_schedules.player2 = g2.id) 
//          left join tournaments
//          on (gamer_tournament_schedules.tournament_id = tournaments.id)
//          left join gamer_tournament_points
//          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
//          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 2 "));
//             $count2=count($stage2);            
//             $stage3=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
//             tournaments.name as tname,gamer_tournament_points.*
//          from gamer_tournament_schedules left join gamers as g1
//          on (gamer_tournament_schedules.player1 = g1.id)
//          left join gamers as g2
//          on (gamer_tournament_schedules.player2 = g2.id) 
//          left join tournaments
//          on (gamer_tournament_schedules.tournament_id = tournaments.id)
//          left join gamer_tournament_points
//          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
//          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 3"));
//             $count3=count($stage3);
//             $stage4=DB::select( DB::raw("select gamer_tournament_schedules.*, g1.fname as Player1fname, g1.lname as Player1lname, g1.email as Player1email, g2.fname as Player2fname, g2.lname as Player2lname, g2.email as Player2email,
//             tournaments.name as tname,gamer_tournament_points.*
//          from gamer_tournament_schedules left join gamers as g1
//          on (gamer_tournament_schedules.player1 = g1.id)
//          left join gamers as g2
//          on (gamer_tournament_schedules.player2 = g2.id) 
//          left join tournaments
//          on (gamer_tournament_schedules.tournament_id = tournaments.id)
//          left join gamer_tournament_points
//          on(gamer_tournament_schedules.id = gamer_tournament_points.schedule_id )
//          where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage= 4"));
//             $count4=count($stage4);

// $stage=Gamer_tournament_schedule::where('tournament_id',$id)->orderBy('stage','desc')->take(1)->get();        
//             if(count($stage)>0){
//              $winner=Gamer_tournament_schedule::where ('tournament_id',$id)
//                     ->select ('gamers.fname as name')
//                     ->join('gamers','gamers.id','gamer_tournament_schedules.winner')
//                     ->where ('gamer_tournament_schedules.stage',$stage[0]->stage)
//                     ->get();        
//                     $count = $winner->count();if($count==1){$winner=$winner;}else{$winner='';}
//                         }else{$winner = '';}

//             return view('website.tournament.fixture',
//                 compact('tournaments','stage1','count1','stage2','count2','stage3','count3','stage4','count4','winner'));

//         }


    public function fixture($id)
    {
        $stages = array();

        $stageDatas = DB::select(DB::raw("select DISTINCT stage from gamer_tournament_schedules where tournament_id=$id"));

        foreach ($stageDatas as $stage) {
            $stage_no = $stage->stage;

            $schedules = array();

            // $schedulesDatas = DB::select(DB::raw("select gamer_tournament_schedules.player1, gamer_tournament_schedules.player2, gamer_tournament_schedules.start_date, gamer_tournament_schedules.start_time, gamer_tournament_points.player1_score, gamer_tournament_points.player2_score
            //     from gamer_tournament_schedules left join gamer_tournament_points
            //     on (gamer_tournament_schedules.id=gamer_tournament_points.schedule_id)
            //     where gamer_tournament_schedules.tournament_id=$id and gamer_tournament_schedules.stage=$stage_no"));

            $schedulesDatas = DB::select(DB::raw("select * from gamer_tournament_schedules where tournament_id='$id' and stage='$stage_no' order by id asc"));

            foreach ($schedulesDatas as $schedule) {
                //die("xyz");
                $player1_id = $schedule->player1;

                $schedule_id = $schedule->id;

                $pointResult = DB::select(DB::raw("select * from gamer_tournament_points where schedule_id='$schedule_id' order by id asc"));

                if (count($pointResult) > 0) {
                    $player1_score = $pointResult[0]->player1_score;
                    $player2_score = $pointResult[0]->player2_score;
                } else {
                    $player1_score = '';
                    $player2_score = '';
                }

                $schedule->player1_score = $player1_score;
                $schedule->player2_score = $player2_score;

                $player1Result = DB::select(DB::raw("select gamers.fname, gamers.lname, gamers.email, gamers_tournaments.in_game_id
                    from gamers join gamers_tournaments
                    on (gamers_tournaments.user_id=gamers.id)
                    where gamers.id=$player1_id and gamers_tournaments.tournament_id=$id"));

                $player2_id = $schedule->player2;
                $player2Result = DB::select(DB::raw("select gamers.fname, gamers.lname, gamers.email, gamers_tournaments.in_game_id
                    from gamers join gamers_tournaments
                    on (gamers_tournaments.user_id=gamers.id)
                    where gamers.id=$player2_id and gamers_tournaments.tournament_id=$id"));

                if (count($player1Result) > 0) {
                    $schedule->player1_name = $player1Result[0]->fname;
                    $schedule->player1_psn = $player1Result[0]->in_game_id;
                } else {
                    $schedule->player1_name = '';
                    $schedule->player1_psn = '';
                }

                if (count($player2Result) > 0) {
                    $schedule->player2_name = $player2Result[0]->fname;
                    $schedule->player2_psn = $player2Result[0]->in_game_id;
                } else {
                    $schedule->player2_name = '';
                    $schedule->player2_psn = '';
                }

                array_push($schedules, $schedule);
            }

            $stage->schedules = $schedules;

            // echo "<pre>";
            // print_r($stage->schedules);


            array_push($stages, $stage);
        }

        $tournaments = Tournaments::find($id);

        return view('website.tournament.fixture', compact('stages', 'tournaments'));
    }

    public function team_fixture($id)
    {
        $stages = array();

        $stageDatas = DB::select(DB::raw("select DISTINCT stage from team_tournament_schedules where tournament_id=$id"));

        foreach ($stageDatas as $stage) {
            $stage_no = $stage->stage;

            $schedules = array();

            // $schedulesDatas = DB::select(DB::raw("select team_tournament_schedules.team1, team_tournament_schedules.team2, team_tournament_schedules.start_date, team_tournament_schedules.start_time, team_tournament_points.team1_score, team_tournament_points.team2_score
            //     from team_tournament_schedules left join team_tournament_points
            //     on (team_tournament_schedules.id=team_tournament_points.team_schedule_id)
            //     where team_tournament_schedules.tournament_id=$id and team_tournament_schedules.stage=$stage_no"));
            $schedulesDatas = DB::select(DB::raw("select * from team_tournament_schedules where tournament_id='$id' and stage='$stage_no'"));

            foreach ($schedulesDatas as $schedule) {
                $team1_id = $schedule->team1;
                $schedule_id = $schedule->id;

                $pointResult = DB::select(DB::raw("select * from team_tournament_points where team_schedule_id='$schedule_id' order by id asc"));

                if (count($pointResult) > 0) {
                    $team1_score = $pointResult[0]->team1_score;
                    $team2_score = $pointResult[0]->team2_score;
                } else {
                    $team1_score = '';
                    $team2_score = '';
                }

                $team1Result = DB::select(DB::raw("select * from teams where id='$team1_id'"));

                $team2_id = $schedule->team2;
                $team2Result = DB::select(DB::raw("select * from teams where id='$team2_id'"));

                if (count($team1Result) > 0) {
                    $schedule->team1_name = $team1Result[0]->team_name;
                } else {
                    $schedule->team1_name = '';
                }

                if (count($team2Result) > 0) {
                    $schedule->team2_name = $team2Result[0]->team_name;
                } else {
                    $schedule->team2_name = '';
                }

                $schedule->team1_score = $team1_score;
                $schedule->team2_score = $team2_score;

                array_push($schedules, $schedule);
            }

            $stage->schedules = $schedules;
            array_push($stages, $stage);
        }

        $tournaments = Tournaments::find($id);

        return view('website.tournament.team_fixture', compact('stages', 'tournaments'));
    }
}
