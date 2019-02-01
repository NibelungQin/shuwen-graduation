<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30
 * Time: 11:38
 */

namespace App\Repositories;


use App\Model\Answer;

class AnswerRepository
{
    /**
     * 关联回答的用户、评论、以及评论的用户
     * @param $id
     * @return mixed
     */
    public function getAnswer($id)
    {
        $where = [
            'question_id' => $id,
            'is_hidden'   => 'F',
        ];
        return Answer::where($where)->with('user','comments')->latest()->paginate(10);
    }

    /**
     * 创建回答问题
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }

    /**
     * 通过答案id获得答案信息
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Answer::find($id);
    }

    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with(['comments','comments.user'])->where('id', $id)->first();
        return $answer->comments;
    }
}
