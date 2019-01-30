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
    public function getAnswer($id)
    {
        $where = [
            'question_id' => $id,
            'is_hidden'   => 'F',
        ];
        return Answer::where($where)->latest()->paginate(10);
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
}
