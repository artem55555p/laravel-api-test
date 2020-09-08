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

Route::middleware('throttle:5,1')->group(function () {
    Route::group(['prefix' => '/v1',
        'namespace' => 'Api\V1',
        'as' => 'api.'], function () {
        Route::post('feedback', 'FeedbackController@save')->name('feedback');
    });
});
