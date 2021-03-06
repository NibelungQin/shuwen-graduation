<?php

namespace App\Http\Controllers;

use App\Events\QuestionCreated;
use App\Events\QuestionViewEvent;
use App\Http\Resources\QuestionResource;
use App\Repositories\QuestionRepository;
use App\Repositories\ReadRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $questionRepository;
    protected $topicRepository;
    protected $readRepository;

    public function __construct(QuestionRepository $questionRepository,
                                   TopicRepository $topicRepository,
                                ReadRepository $readRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->topicRepository = $topicRepository;
        $this->readRepository = $readRepository;
    }

    /**
     * 获得所有问题
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $questions = $this->questionRepository->getQuestionFeed();
        return QuestionResource::collection($questions);
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

        //当创建新的问题时发送广播
        event(new QuestionCreated($question));

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
        if (user('api')){
            $this->readRepository->store($id,'App\Model\Question');
        }
        //获取客户端请求的IP
        $ip = \request()->getClientIp();
        //触发浏览次数统计时间
        event(new QuestionViewEvent($question,$ip));
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
