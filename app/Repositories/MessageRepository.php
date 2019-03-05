<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25
 * Time: 10:59
 */

namespace App\Repositories;


use App\Model\Message;

class MessageRepository
{
    /**
     * 保存私信信息到数据库
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    /**
     * 获得登录用户发送和接收的信息
     * @return mixed
     */
    public function getAllMessages()
    {
        return Message::where('from_user_id',user('api')->id)
            ->orWhere('to_user_id',user('api')->id)
            ->with(['fromUser'=>function($query){
                return $query->select(['id','name','avatar']);
            },'toUser'=>function($query){
                return $query->select(['id','name','avatar']);
            }])->latest()->get();
    }

    public function getDialogMessage($dialogId,$page=0)
    {
        $count = count(Message::where('dialog_id',$dialogId)->get());
        $messages = Message::where('dialog_id',$dialogId)
            ->with(['fromUser'=>function($query){
                return $query->select(['id','name','avatar']);
            },'toUser'=>function($query){
                return $query->select(['id','name','avatar']);
            }])->latest()->offset($page)->limit(10)->get();
        return ['count'=>$count, 'messages'=>$messages];
    }

    public function getSingleMessage($dialogId)
    {
        return Message::where('dialog_id',$dialogId)->first();
    }
}
