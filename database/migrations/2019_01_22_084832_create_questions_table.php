<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');//问题标题
            $table->text('body');//问题内容
            $table->integer('user_id')->unsigined();//问题发布人
            $table->integer('comments_count')->default(0);//问题评论数
            $table->integer('followers_count')->default(0);//问题被多少人关注
            $table->integer('answers_count')->default(0);//回答问题数
            $table->string('close_comment',8)->default('F');//是否关闭评论
            $table->string('is_hidden',8)->default('F');//是否隐藏该问题
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
        Schema::dropIfExists('questions');
    }
}
