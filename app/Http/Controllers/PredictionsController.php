<?php

namespace App\Http\Controllers;

use App\Teams;
use App\Predictions;
use Illuminate\Http\Request;
use App\UserOverallPredictions;
use Illuminate\Support\Facades\Auth;

class PredictionsController extends Controller
{
    public function index() {
    	$data = [];
    	$data['teams'] = Teams::all()->pluck('name', 'id');
    	$data['predictions'] = Predictions::where('type', 'overall')->get();
    	$data['user_predictions'] = UserOverallPredictions::where('user_id', Auth::id())->get()->pluck('user_predicted_id','prediction_id');
    	return view('admin.predictions', $data);
    }

    public function saveUserPrediction(Request $request) {

    	UserOverallPredictions::where('user_id', Auth::id())->where('prediction_id', $request->id)->delete();

    	UserOverallPredictions::create(['user_id' => Auth::id(), 'prediction_id' => $request->id, 'user_predicted_id' => $request->userPredictedTeamId]);
    }
}
