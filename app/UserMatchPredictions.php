<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMatchPredictions extends Model
{
    protected $fillable = ['user_id', 'match_id', 'user_selected_team_id'];
}
