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


Route::group(['prefix' => 'api/v2', 'middleware' => 'cors'], function(){
    Route::get('data', 'Api\ServiceController@initData');

    Route::get('leads', 'Api\ServiceController@addLeads');  // to remake POST

    Route::get('services/{lang}', 'Api\ServiceController@all');
    Route::get('service', 'Api\ServiceController@getOneService');
    Route::get('translations', 'Api\TranslationsController@all');

    Route::get('promotions', 'Api\PromotionController@get');
});
