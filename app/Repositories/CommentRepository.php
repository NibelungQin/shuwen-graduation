<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 16:12
 */

namespace App\Repositories;


use App\Model\Comment;

class CommentRepository
{
    public function getList($commentableId,$commentableType)
    {
        $comments = Comment::where('commentable_id',$commentableId)
            ->where('commentable_type',$commentableType)
            ->with(['user' => function ($query) {
                return $query->select('id', 'name', 'avatar');
            }, 'reply_user' => function ($query) {
                return $query->select('id', 'name', 'avatar');
            }])
            ->get()
            ->groupBy('parent_id');
        //评论不为空，对数据做处理
        if (! $comments->isEmpty()){
            $comments['root'] = $comments[0];
            unset($comments[0]);
        }
        //获取总评论数
        $comments['count'] = Comment::where('commentable_id', $commentableId)
            ->where('commentable_type', $commentableType)
            ->count();
        return $comments;
    }

    public function userReply($userId)
    {
        $comments = Comment::where([
                ['user_id',$userId],
                ['parent_id',0],
                ['commentable_type','<>','App\\Model\\Answer']
            ])
            ->orWhere([
                ['reply_user_id',$userId],
                ['parent_id','<>',0],
                ['commentable_type','<>','App\\Model\\Answer']
            ])
            ->with(['user' => function ($query) {
                return $query->select('id', 'name', 'avatar');
            }, 'reply_user' => function ($query) {
                return $query->select('id', 'name', 'avatar');
            }, 'commentable'])
            ->latest()
            ->paginate(10);
        return $comments;
    }

    public function byId($id)
    {
        return Comment::find($id);
    }
    
    public function store(array $attributes)
    {
        return Comment::create($attributes);
    }
}
