<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 16:12
 */

namespace App\Repositories;


use App\Model\Comment;

class CommentRepository
{
    public function store(array $attributes)
    {
        return Comment::create($attributes);
    }
}
