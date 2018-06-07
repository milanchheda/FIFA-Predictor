<?php

namespace App\Http\Controllers;

use App\Teams;
use App\Matches;
use Illuminate\Http\Request;
use App\UserMatchPredictions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FixturesController extends Controller
{
    public function index() {
    	$matches = Matches::select('id', 'home_team', 'away_team', 'date', 'lock_time', 'finished', 'winning_team_id')->get();
        $data = [];
        $data['matches'] = $matches;
        $data['teams'] = Teams::all()->pluck('name', 'id', 'iso2');
        $data['teams_short'] = Teams::all()->pluck('iso2', 'id');
        $data['user_predictions'] = UserMatchPredictions::where('user_id', Auth::id())->get()->pluck('user_selected_team_id','match_id');
    	return view('admin.index', $data);
    }

    public function saveUserSelections(Request $request) {
        if($request->winner){
            Matches::where('id', $request->id)->update(['finished' => 1, 'winning_team_id' => $request->userPredictedTeamId]);
            $userOverallPredictionIds = UserMatchPredictions::where('match_id', $request->id)->get()->pluck('id');
            foreach ($userOverallPredictionIds as $eachItem) {
                $userPrediction = UserMatchPredictions::find($eachItem);
                if($userPrediction->user_selected_team_id == $request->userPredictedTeamId)
                    $userPrediction->points_obtained = 100;
                else
                    $userPrediction->points_obtained = -25;
                $userPrediction->save();
            }
            return response()->json(['message' => 'Successfully saved.'], 200);
        } else {
            $getLockTime = Matches::select('lock_time', 'finished')->where('id', $request->id)->get()->toArray();
            $now = Carbon::now();
            $seconds = Carbon::parse($getLockTime[0]['lock_time'])->diffInSeconds($now, false, false, 6);
            if($seconds < 0 && !$getLockTime[0]['finished']) {
                UserMatchPredictions::where('user_id', Auth::id())->where('match_id', $request->id)->delete();
                UserMatchPredictions::create(['user_id' => Auth::id(), 'match_id' => $request->id, 'user_selected_team_id' => $request->userPredictedTeamId]);
                return response()->json(['message' => 'Successfully saved.'], 200);
            } else {
                return response()->json(['message' => 'Time\'s over.!'], 403);
            }
        }
    }
}
