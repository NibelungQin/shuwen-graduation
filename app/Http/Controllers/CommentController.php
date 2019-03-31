<?php

namespace App\Http\Controllers;

use App\Events\NotificationPushEvent;
use App\Model\Comment;
use App\Notifications\ReceivedCommentNotification;
use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $answerRepository;
    protected $questionRepository;

    public function __construct(CommentRepository $commentRepository,
                                AnswerRepository $answerRepository,
                                QuestionRepository $questionRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * 提交父评论 子评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //判断是否有父id
        if ($request->has('parent_id')){
            //获得父评论详情
            $real_comment = $this->commentRepository->byId($request->input('parent_id'));
            //当前评论等级+1
            $level = $real_comment->level + 1;
            //当父等级大于0时评论人应该是回复用户id
            $user_id = $real_comment->reply_user_id ?: $real_comment->user_id;
            if ($real_comment->level > 0){
                $user_id = $real_comment->reply_user_id;
            }
            //限制等级只为2
            if ($level >= 2){
                $level = 2;
            }
        }
        // 合并所需数据
        $data = array_merge($request->all(),[
            'user_id' => isset($user_id) ? $user_id : user('api')->id,
            'level'   => isset($level) ? $level : 0,
            'commentable_type' => $this->getModelNameFromType($request->input('commentable_type')),
            'parent_id' => $request->input('parent_id',0),
            'reply_user_id' => isset($user_id) ? user('api')->id : 0
        ]);
        $comment = $this->commentRepository->store($data);
        // 对评论数据进行修正
        if (! $comment->parent_id) {
            $comment->fill([
                'user_id' => $comment->commentable->user->id,
                'reply_user_id' => $comment->user_id
            ]);

            $comment->save();
        }
        $new_comment = Comment::where('id', $comment->id)->with(['user', 'reply_user'])->first();

        //发送私信
        $comment->user->notify(new ReceivedCommentNotification($comment));

        broadcast(new NotificationPushEvent($comment->user));
        return response()->json($new_comment);
    }

    /**
     * 显示评论列表
     * @param Request $request
     * @param $commentableId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request,$commentableId)
    {
        //获取评论类型，评论是多态，限制返回类型
        $commentableType = $this->getModelNameFromType($request->input('type'));
        $comments = $this->commentRepository->getList($commentableId,$commentableType);
        return response()->json($comments);
    }

    /**
     * 显示多态评论是属于哪一种
     * @param $type
     * @return string
     */
    public function getModelNameFromType($type)
    {
        if ($type === 'question'){
            return 'App\Model\Question';
        }elseif ($type === 'answer'){
            return 'App\Model\Answer';
        }elseif ($type === 'article'){
            return 'App\Model\Article';
        }
    }

    /**
     * 删除评论（父评论+子评论）
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->recursive($id);
        return response()->json([
            'message' => '删除评论成功'
        ]);
    }

    /**
     * 递归删除评论
     * @param $id
     * @return bool
     */
    public function recursive($id)
    {
        $comment = $this->commentRepository->byId($id);
        $comment->delete();
        $child_comment = Comment::where('parent_id',$comment->id)->first();
        if (!$child_comment){
            return true;
        }
        $this->recursive($child_comment->id);
    }

    public function answer($id)
    {
        return $this->answerRepository->getAnswerCommentsById($id);
    }

    public function question($id)
    {
        return $this->questionRepository->getQuestionCommentsById($id);
    }
}
