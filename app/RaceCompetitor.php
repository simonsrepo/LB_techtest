<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceCompetitor extends Model
{
    protected $table = 'race_competitor';

    public function startingGrid(int $raceID, int $competitorID, int $position)
    {
        $this->race_id = $raceID;
        $this->competitor_id = $competitorID;
        $this->position = $position;
    }

    public function getCompetitor()
    {
        return $this->hasOne('App\Competitor', 'id', 'competitor_id');
    }
}
