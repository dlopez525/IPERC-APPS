<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["middleware" => "apikey.validate"], function () {
    Route::post('get-headquarters', 'ApiController@getHeadquarters');
    Route::post('login', 'ApiController@apiLogin');
    Route::post('get-job-positions', 'ApiController@getJobPositions');
    Route::post('get-areas', 'ApiController@getAreas');
    Route::post('get-zones', 'ApiController@getZones');
    Route::post('get-sub-processes', 'ApiController@getSubProcesses');
    Route::post('audits', 'ApiController@audit');
    Route::post('get-activities', 'ApiController@getActivities');
    Route::post('get-tasks', 'ApiController@getTasks');
    Route::post('get-task-danger', 'ApiController@getTaskDanger');
    Route::post('get-iperc', 'ApiController@getIperc');
});