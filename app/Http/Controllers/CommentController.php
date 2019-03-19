<?php

namespace App\Http\Controllers;

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

    public function store()
    {
        $model = $this->getModelNameFromType(\request('type'));

        return $this->commentRepository->store([
            'user_id' => user('api')->id,
            'body'    => \request('body'),
            'commentable_id' => \request('model'),
            'commentable_type' => $model
        ]);
    }

    public function getModelNameFromType($type)
    {
        if ($type === 'question'){
            return 'App\Model\Question';
        }elseif ($type === 'answer'){
            return 'App\Model\Answer';
        }else{
            return 'App\Model\Post';
        }
//        return $type === 'question' ? 'App\Model\Question' : 'App\Model\Answer';
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
