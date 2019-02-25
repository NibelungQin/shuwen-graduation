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

Route::get('/questions/{id}/answer','AnswerController@index');
Route::post('/questions/{id}/answer','AnswerController@store');

Route::post('/question/follower','QuestionFollowController@follower');
Route::post('/question/follow','QuestionFollowController@followThisQuestion');

Route::get('/answer/{id}/comment','CommentController@answer');
Route::get('/question/{id}/comment','CommentController@question');
Route::post('/comment','CommentController@store');

Route::post('/answer/{id}/votes/users','VoteController@voted');
Route::post('/answer/vote','VoteController@voteThisAnswer');

Route::get('/user/followers/{id}','FollowController@index');
Route::post('/user/follow','FollowController@follow');

Route::post('/message/store','MessageController@store');
Route::get('/notifications','NotificationController@index');
Route::post('/notifications/unread','NotificationController@unread');

Route::get('/inbox','InboxController@index');
Route::get('/inbox/first','InboxController@firstMessage');
Route::get('/inbox/last','InboxController@lastMessage');
Route::get('/inbox/from','InboxController@fromUser');
Route::get('/inbox/to','InboxController@toUser');

Route::get('/topics','TopicController@index');

Route::post('/upload/img','UploadController@image');
