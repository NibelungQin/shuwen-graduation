<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function index($id)
    {
        $answers = $this->answerRepository->getAnswer($id);
        return response()->json($answers,200);
    }

    /**
     * 新建问题的答案
     * @param $question
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($question)
    {
        $data = [
            'user_id'     => user('api')->id,
            'question_id' => $question,
            'body'        => \request('body')
        ];
        $answer = $this->answerRepository->create($data);
        $answer->questions()->increment('answers_count');
        $newAnswer = $this->answerRepository->byId($answer->id);
        return response()->json([
            'data' => $newAnswer,
            'status'  => true,
            'message' => '答案添加成功'
        ],200);
    }

    /**
     * 将该回答进行隐藏，需要点击显示隐藏的回答才会出现
     * @param $id integer 答案id
     * @return \Illuminate\Http\JsonResponse
     */
    public function isHidden($id)
    {
        $answer = $this->answerRepository->byId($id);
        $data = [
            'is_hidden' => 'T'
        ];
        $answer->update($data);
        return response()->json([
            'status' => true,
            'message' => '该问题已成功隐藏',
        ],200);
    }

    /**
     * 将该答案的评论功能关闭
     * @param $id integer 答案id
     * @return \Illuminate\Http\JsonResponse
     */
    public function closeComment($id)
    {
        $answer = $this->answerRepository->byId($id);
        $data = [
            'close_comment' => 'T'
        ];
        $answer->update($data);
        return response()->json([
            'status'  => true,
            'message' => '已关闭该答案评论'
        ],200);
    }
}
