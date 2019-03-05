<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25
 * Time: 16:34
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    public function markAsRead()
    {
        $this->each(function ($message){
            if ($message->to_user_id === user('api')->id ){
                $message->markAsRead();
            }
        });
    }
}
