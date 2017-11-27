<?php

namespace App\Http\Controllers\api;

use App\Race;
use App\Competitor;
use App\RaceCompetitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Race::withCount('competitors')->get();
    }

    public function raceInfo(Int $raceID)
    {
        $races = Race::find($raceID)->with('competitors')->first();

        $raceInfo = array();
        $raceInfo['meeting'] = $races->meeting;
        $raceInfo['type'] = $races->type;
        $raceInfo['closeTime'] = $races->closeTime;
        $raceInfo['eventTime'] = $races->eventTime;

        foreach ($races->competitors as $competitor) {
            $raceCompetitors = array();
            $raceCompetitors['competitorName'] = $competitor->getCompetitor->name;
            $raceCompetitors['position'] = $competitor->position;

            $raceInfo['competitors'][] = $raceCompetitors;
        }

        return $raceInfo;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $raceTypes = array('Thoroughbred', 'Greyhounds', 'Harness');

        $closeTime = new \DateTime();
        $eventTime = new \DateTime();

        $closeTime->add(new \DateInterval('PT6000S'));
        $eventTime->add(new \DateInterval('PT6030S'));

        $race = New Race;

        $race->meeting = 'test';
        $race->type = $raceTypes[0];
        $race->closeTime = $closeTime;
        $race->eventTime = $eventTime;

        $race->save();
        return array('OK');
    }

    public function event(Int $raceID, Int $competitorID, Int $position)
    {
        $race = Race::findOrFail($raceID);
        $competitor = Competitor::findOrFail($competitorID);

        $raceCompetitor = new RaceCompetitor();
        $raceCompetitor->startingGrid($raceID, $competitorID, $position);
        $raceCompetitor->save();
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
     * @param  \App\Races  $races
     * @return \Illuminate\Http\Response
     */
    public function show(Races $races)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Races  $races
     * @return \Illuminate\Http\Response
     */
    public function edit(Races $races)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Races  $races
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Races $races)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Races  $races
     * @return \Illuminate\Http\Response
     */
    public function destroy(Races $races)
    {
        //
    }
}
