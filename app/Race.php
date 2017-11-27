<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function competitors()
    {
        return $this->hasMany('App\RaceCompetitor');
    }
}
