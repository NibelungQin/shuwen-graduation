<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'parent_id', 'level', 'reply_user_id', 'body', 'commentable_id', 'commentable_type'];

    /**
     * 将评论、帖子、问题和回答进行多态关联
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * 评论用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 回复用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reply_user()
    {
        return $this->belongsTo(User::class);
    }
}
