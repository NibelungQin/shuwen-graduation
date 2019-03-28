<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('帖子标题');
            $table->text('content')->comment('帖子内容');
            $table->string('image')->comment('图片');
            $table->string('description')->comment('帖子描述');
            $table->integer('user_id')->unsigined()->comment('帖子发布人');
            $table->string('is_original')->default('T')->comment('是否原创');
            $table->timestamp('published_at')->comment('发布时间');
            $table->unsignedInteger('last_user_id')->comment('最后一次评论id');
            $table->integer('comments_count')->default(0)->comment('帖子评论数');
            $table->integer('followers_count')->default(0)->comment('帖子被多少人关注');
            $table->bigInteger('view_count')->default(0)->comment('帖子浏览数');
            $table->string('close_comment',8)->default('F')->comment('是否关闭评论');
            $table->string('is_hidden',8)->default('F')->comment('是否隐藏该帖子');
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
        Schema::dropIfExists('articles');
    }
}
