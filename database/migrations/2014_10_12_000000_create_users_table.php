<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();//用户名
            $table->string('email')->unique();//用户邮箱
            $table->string('password');//用户密码
            $table->string('avatar');//用户头像
            $table->string('confirmation_token');//用户邮箱确认token
            $table->smallInteger('is_active')->default(0);//用户是否已激活邮箱
            $table->integer('questions_count')->default(0);//用户发起问题数
            $table->integer('answers_count')->default(0);//用户问题答案数
            $table->integer('comments_count')->default(0);//用户评论问题数
            $table->integer('favourites_count')->default(0);//用户
            $table->integer('likes_count')->default(0);//
            $table->integer('followers_count')->default(0);//该用户关注其他人数
            $table->integer('followings_count')->default(0);//该用户被多少人关注
            $table->json('settings')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
