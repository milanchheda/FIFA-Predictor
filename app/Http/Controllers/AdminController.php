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
        $newArray = [];
        foreach ($matchesleaderBoard as $key => $value) {
            if(isset($overallleaderBoard[$key]))
                $newArray[$key] = $matchesleaderBoard[$key] + $overallleaderBoard[$key];
            else
                $newArray[$key] = $matchesleaderBoard[$key];
        }

        asort($newArray, SORT_NUMERIC);
        $data['leaderboard'] = array_reverse($newArray, true);
        return view('leaderboard', $data);
    }

    public function getPlayers(Request $request) {
        $players = Players::where('name', 'like', '%' . $request->term . '%')->get()->pluck('name', 'id');
        $return_array = [];
        foreach ($players as $key => $value) {
            $return_array[] = array('value' => $value, 'id' =>$key);
        }
        return Response::json($return_array);
    }

    public function checkifNeedFix() {
        $userIds = User::where('id', '!=', 1)->pluck('id')->toArray();
        $matches = Matches::where('finished', 1)->get()->pluck('id')->toArray();
        $predictions = Predictions::whereNotNull('winning_id')->get()->pluck('id')->toArray();
        foreach ($userIds as $key => $value) {
            $userMatchIds = UserMatchPredictions::where('user_id', $value)->orderBy('match_id')->get()->pluck('match_id')->toArray();
            $resultArray = array_diff($matches, $userMatchIds);
            if(isset($resultArray) && !empty($resultArray)) {
                echo $value;
                print_r($resultArray);
            }

            $userOverallMatchIds = UserOverallPredictions::where('user_id', $value)->orderBy('prediction_id')->get()->pluck('prediction_id')->toArray();
            $overallResultArray = array_diff($predictions, $userOverallMatchIds);
            if(isset($overallResultArray) && !empty($overallResultArray)) {
                echo $value;
                print_r($overallResultArray);
            }
        }
    }

    public function fixScores() {
        $userIds = User::where('id', '!=', 1)->pluck('id')->toArray();
        $matches = Matches::where('finished', 1)->get()->pluck('id')->toArray();
        $predictions = Predictions::whereNotNull('winning_id')->get()->pluck('id')->toArray();
        foreach ($userIds as $key => $value) {
            $userMatchIds = UserMatchPredictions::where('user_id', $value)->orderBy('match_id')->get()->pluck('match_id')->toArray();
            $resultArray = array_diff($matches, $userMatchIds);
            if(isset($resultArray) && !empty($resultArray)) {
                foreach ($resultArray as $k => $v) {
                    UserMatchPredictions::create(
                        [
                        'user_id' => $value,
                        'match_id' => $v,
                        'user_selected_team_id' => -2,
                        'points_obtained' => -25
                        ]
                    );
                }
            }

            $userOverallMatchIds = UserOverallPredictions::where('user_id', $value)->orderBy('prediction_id')->get()->pluck('prediction_id')->toArray();
            $overallResultArray = array_diff($predictions, $userOverallMatchIds);
            if(isset($overallResultArray) && !empty($overallResultArray)) {
                foreach ($overallResultArray as $ok => $ov) {
                    UserOverallPredictions::create(
                        [
                        'user_id' => $value,
                        'prediction_id' => $ov,
                        'user_predicted_id' => -2,
                        'points_obtained' => -50
                        ]
                    );
                }
            }
        }
    }
}
