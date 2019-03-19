<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');//帖子标题
            $table->text('body');//帖子内容
            $table->integer('user_id')->unsigined();//帖子发布人
            $table->integer('comments_count')->default(0);//帖子评论数
            $table->integer('followers_count')->default(0);//帖子被多少人关注
            $table->bigInteger('view_count');//帖子浏览数
            $table->string('close_comment',8)->default('F');//是否关闭评论
            $table->string('is_hidden',8)->default('F');//是否隐藏该帖子
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
