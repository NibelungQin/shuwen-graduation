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

Route::get('/home/carousel','HomeController@carousel');
Route::get('/home/readLog','HomeController@readLog');
Route::get('/home/articles','HomeController@articles');
Route::get('/home/questions','HomeController@questions');
Route::get('/home/recommend','HomeController@recommend');
Route::get('/home/reads','HomeController@reads');

Route::get('/reads','ReadController@index');

Route::get('/articles','ArticlesController@index');
Route::post('/articles','ArticlesController@store');
Route::get('/articles/{id}','ArticlesController@show');
Route::post('/articles/{id}','ArticlesController@update');

Route::post('/article/follower','ArticleFollowController@follower');
Route::post('/article/follow','ArticleFollowController@followThisArticle');

Route::post('/article/{id}/votes/users','VoteController@articleVoted');
Route::post('/article/vote','VoteController@voteThisArticle');

Route::get('commentable/{commentableId}/comment', 'CommentController@show')->name('comments.show');
Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');

# ------------------- 用户详情 ----------------------------
Route::get('users/{username}', 'UserController@show')->name('users.show');
# ------------------- 修改头像 ----------------------------
Route::put('users/{username}/avatar', 'UserController@avatar')->name('users.avatar');
# ------------------- 用户评论 ----------------------------
Route::get('users/{username}/replies', 'UserController@replies')->name('users.replies');
# ------------------- 用户关注 ----------------------------
Route::get('users/{username}/following', 'UserController@following')->name('users.following');

Route::get('/questions','QuestionController@index');
Route::post('/questions','QuestionController@store');
Route::get('/questions/{id}','QuestionController@show');
Route::post('/questions/{id}','QuestionController@update');

Route::get('/questions/{id}/answer','AnswerController@index');
Route::post('/questions/{id}/answer','AnswerController@store');

Route::post('/question/follower','QuestionFollowController@follower');
Route::post('/question/follow','QuestionFollowController@followThisQuestion');

Route::post('/question/{id}/votes/users','VoteController@questionVoted');
Route::post('/question/vote','VoteController@voteThisQuestion');

Route::get('/answer/{id}/comment','CommentController@answer');
Route::get('/question/{id}/comment','CommentController@question');
Route::post('/comment','CommentController@store');

Route::post('/answer/{id}/votes/users','VoteController@voted');
Route::post('/answer/vote','VoteController@voteThisAnswer');

Route::get('/user/followers/{id}','FollowController@index');
Route::post('/user/follow','FollowController@follow');

Route::post('/message/store','MessageController@store');
Route::get('/notifications','NotificationController@index');
Route::get('/notifications/count','NotificationController@getUnreadCount');
Route::get('/notifications/{notification}','NotificationController@show');

Route::get('/inbox','InboxController@index');
Route::get('inbox/{dialogId}','InboxController@show');
Route::post('inbox/{dialogId}/store','InboxController@store');
Route::get('/friend/sender/{id}','FriendController@index');
Route::post('/friend/send','FriendController@send');
Route::post('/friend/accept','FriendController@receiver');

Route::get('/topics','TopicController@index');

Route::post('/upload/img','UploadController@image');


Route::get('/book/category','BookController@category');
Route::get('/book/novelList','BookController@novelList');
Route::get('/book/catDetail','BookController@catDetail');
Route::get('/book/getBook','BookController@getBook');