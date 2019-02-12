<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $questionRepository;
    protected $topicRepository;

    public function __construct(QuestionRepository $questionRepository,
                                   TopicRepository $topicRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->topicRepository = $topicRepository;
    }

    public function index()
    {
        //独家记忆 exclusive memory
    }

    /**
     * 发布问题
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $topics = $this->topicRepository->normalizeTopic(\request('topics'));
        $data = [
            'title' => \request('title'),
            'body'  => \request('body'),
            'user_id' => user('api')->id,
        ];

        $question = $this->questionRepository->create($data);
        $question->topics()->attach($topics);

        return response()->json([
            'status' => true,
            'msg'    => '问题创建成功'
        ],200);
    }

    /**
     * 展示问题
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $question = $this->questionRepository->byIdWithTopicAndUser($id);
        return response()->json([
            'status'  => true,
            'data'    => $question,
            'message' => '获得问题信息成功'
        ],200);
    }

    /**
     * 修改问题
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $question = $this->questionRepository->byId($id);

        $topics = $this->topicRepository->normalizeTopic(\request('topics'));
        $data = [
            'title' => \request('title'),
            'body'  => \request('body'),
        ];
        $question->update($data);
        $question->topics()->sync($topics);

        return response()->json([
            'status'  => true,
            'message' => '问题修改成功'
        ],200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->byId($id);
        $question->delete();

        return response()->json([
           'status'  => true,
           'message' => '问题删除成功'
        ],200);
    }
}
