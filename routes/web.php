<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('page.racelist');
})->name('home');

Route::get('/race/{raceID?}', function ($raceID = 0) {
    return view('page.race', ['raceID' => $raceID]);
})->name('race');
