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

Route::post('/register','Auth\RegisterController@register');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout');
Route::post('/token/refresh','Auth\LoginController@refresh');

Route::post('/questions','QuestionController@store');
Route::get('/questions/{id}','QuestionController@show');
Route::post('/questions/{id}','QuestionController@update');

Route::post('/question/follower','QuestionFollowController@follower');
Route::post('/question/follow','QuestionFollowController@followThisQuestion');

Route::get('/topics','TopicController@index');

Route::post('/upload/img','UploadController@image');
