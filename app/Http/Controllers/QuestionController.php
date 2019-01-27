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
            'status' => 200,
            'msg'    => 'success'
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $question = $this->questionRepository->byId($id);
        return response()->json([
            'status' => 200,
            'data'   => $question,
            'msg'    => 'success'
        ]);
    }

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
            'status' => 200
        ]);
    }
}
