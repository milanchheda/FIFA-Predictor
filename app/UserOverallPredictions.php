<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOverallPredictions extends Model
{
	protected $fillable = ['user_id', 'prediction_id', 'user_predicted_id'];
}
