<?php

namespace App\Http\Controllers;

use App\User;
use App\Teams;
use App\Matches;
use App\Players;
use Carbon\Carbon;
use App\Predictions;
use Illuminate\Http\Request;
use App\UserMatchPredictions;
use App\UserOverallPredictions;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index() {
    	$matches = Matches::select('id', 'home_team', 'away_team', 'date', 'lock_time')->get();
        $data = [];
        $data['matches'] = $matches;
        $data['teams'] = Teams::all()->pluck('name', 'id');
    	return view('admin.index', $data);
    }

    public function setLockTimes() {
    	$matches = Matches::select('id', 'home_team', 'away_team', 'date', 'lock_time', 'finished')->get();
        $data = [];
        $data['matches'] = $matches;
        $data['teams'] = Teams::all()->pluck('name', 'id');
    	return view('admin.index', $data);
    }

    public function saveLockTimes(Request $request)
    {
    	$match = Matches::find($request->id);
    	$match->lock_time = Carbon::parse($match->date)->subMinutes($request->time);
    	$match->save();
        return 'ok';
    }

    public function getPredictions() {
    	$data = [];
    	$data['teams'] = Teams::all();
    	$data['predictions'] = Predictions::all();
    	return view('admin.predictions', $data);
    }

    public function savePredictions(Request $request) {
    	if($request->id && $request->predictionWinnerId) {
    		$prediction = Predictions::find($request->id);
	    	$prediction->winning_id = $request->predictionWinnerId;
	    	$prediction->save();

            $userOverallPredictionIds = UserOverallPredictions::where('prediction_id', $request->id)->get()->pluck('id');
            foreach ($userOverallPredictionIds as $eachItem) {
                $userPrediction = UserOverallPredictions::find($eachItem);
                if($userPrediction->user_predicted_id == $request->predictionWinnerId)
                    $userPrediction->points_obtained = $prediction->plus;
                else
                    $userPrediction->points_obtained = $prediction->minus * -1;
                $userPrediction->save();
            }

	        return 'ok';
    	}
    }

    public function savePredictionLockTime(Request $request) {
        if($request->id && $request->selectedPredictionLockTime) {
            $prediction = Predictions::find($request->id);
            $prediction->lock_time = Carbon::parse($prediction->date)->subMinutes($request->selectedPredictionLockTime);
            $prediction->save();
            return 'ok';
        }
    }

    public function showLeaderBoard() {
        $matchesleaderBoard = UserMatchPredictions::groupBy('user_id')->selectRaw('sum(points_obtained) as sum, user_id')->pluck('sum','user_id');
        $overallleaderBoard = UserOverallPredictions::groupBy('user_id')->selectRaw('sum(points_obtained) as sum, user_id')->pluck('sum','user_id');

        $data['users'] = User::all()->pluck('name', 'id');

        foreach ($matchesleaderBoard as $key => $value) {
            if(isset($overallleaderBoard[$key]))
                $matchesleaderBoard[$key] += $overallleaderBoard[$key];
        }

        $data['leaderboard'] = $matchesleaderBoard;
        return view('leaderboard', $data);
    }

    public function getPlayers(Request $request) {
        $players = Players::where('name', 'like', '%' . $request->term . '%')->get()->pluck('name', 'id');
        foreach ($players as $key => $value) {
            $return_array[] = array('value' => $value, 'id' =>$key);
        }
        return Response::json($return_array);
    }
}
