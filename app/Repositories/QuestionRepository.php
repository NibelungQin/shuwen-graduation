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
     * 获得问题及其相关联的标签与创建用户信息
     * @param $id
     * @return mixed
     */
    public function byIdWithTopicAndUser($id)
    {
        return Question::where('id',$id)->with(['topics','comments','user'])->first();
    }

    public function getQuestionFeed($page=0)
    {
        $count = count(Question::all());
        $questions = Question::latest('created_at')->with('user')->offset($page)->limit(10)->get();
        return ['count'=>$count, 'questions'=>$questions];
    }

    /**
     * 获得问题
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Question::find($id);
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

    /**
     * 获得问题关联的评论及其评论的用户信息
     * @param $id
     * @return mixed
     */
    public function getQuestionCommentsById($id)
    {
        $question = Question::with(['comments', 'comments.user'])->where('id', $id)->first();
        return $question->comments;
    }
}
