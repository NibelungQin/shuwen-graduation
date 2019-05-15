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
        return Question::where('id',$id)->withCount('answers')->with(['topics','comments','user'])->first();
    }

    public function getQuestionFeed()
    {
        $questions = Question::latest('created_at')->paginate(10);
        $questions->load(['user'=>function($query){
            return $query->select(['id','name','avatar']);
        }]);
        return $questions;
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

    /**
     * 首页六条最新的问答
     * @return mixed
     */
    public function homeQuestions()
    {
        return Question::with(['topics'])->latest('created_at')->take(4)->get();
    }
}
