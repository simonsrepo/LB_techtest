<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    [
        'namespace'=>'api',
    ],
    function () {
        Route::get('races', 'RacesController@index');
        Route::get('races/create', 'RacesController@create');

        Route::get('races/competitors/{raceID}', 'RacesController@raceInfo');

        Route::get('event/{raceID}/{competitorID}/{position}', 'RacesController@event');
        
        Route::get('competitors', 'CompetitorsController@index');
        Route::get('competitors/create', 'CompetitorsController@create');

        
    }
);