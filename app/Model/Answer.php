<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['user_id','question_id','body'];

    /**
     * 进行问题与答案的关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
}
