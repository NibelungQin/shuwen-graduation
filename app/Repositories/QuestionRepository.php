<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/22
 * Time: 16:52
 */

namespace App\Repositories;


use App\Model\Question;

class QuestionRepository
{
    /**
     * 获得问题
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Question::where('id',$id)->with(['topics'])->first();
    }

    /**
     * 创建问题
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Question::create($attributes);
    }
}
