<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user_room_{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('userOnline.{id}', function ($user, $id) {
    //（私聊中添加好友->请求添加好友）+ （搜索框中搜索用户->请求添加好友）->notification获得消息
});
