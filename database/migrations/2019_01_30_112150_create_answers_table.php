<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();//回答用户id
            $table->integer('question_id')->index()->unsigned();//问题id
            $table->text('body');//回答内容
            $table->integer('votes_count')->default(0);//回答点赞数
            $table->integer('comments_count')->default(0);//回答的评论数
            $table->string('is_hidden',8)->default('F');//是否隐藏该回答
            $table->string('close_comment',8)->default('F');//是否关闭该回答的评论
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
        Schema::dropIfExists('answers');
    }
}
