<template>
    <div>
        <div class="jumbotron">
            <!--使用v-if防止未渲染前先获得了question数据而报错 -->
            <div class="container" v-if="question">
                <div class="media">
                    <div>
                        <a href="#">
                            <img class="rounded-circle" :src="question.user.avatar" alt="64x64" style="height: 64px ;width: 64px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">{{question.user.name}}</h5>
                        <h6>{{question.created_at | formatDate}} 提问</h6>
                        <user-follow-button :user="question.user.id"></user-follow-button>
                        <send-message :user="question.user.id"></send-message>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" v-if="question">
            <div class="row">
                <div class="col-md-12" role="main">
                    <div class="post-topheader__info">
                        <h1 class="h2 post-topheader__info--title">
                            <span href="">{{question.title}}</span>
                        </h1>
                        <ul class="taglist--inline inline-block question__title--tag" v-for="topic in question.topics">
                            <li class="tagPopup">
                                <a class="topic">{{topic.name}} </a>
                            </li>
                        </ul>
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true">{{question.view_count}}次浏览</span>
                    </div>
                    <div class="card-body">
                        <div class="question">
                            <p v-html="question.body"></p>
                        </div>
                    </div>

                    <div>
                        <div class="visit">
                            <question-follow-button :question="question.id"></question-follow-button>
                            <button class="btn btn-dark btn-sm">收藏</button>
                            <button
                                    class="btn btn-primary btn-sm"
                                    @click="is_comment=!is_comment"
                            ><i class="el-icon-edit"></i> 评论 {{Object.keys(question.comments).length}}</button>
                            <button
                                    class="btn btn-success btn-sm"
                                    @click="is_answer=!is_answer"
                            >回答</button>
                            <el-dropdown trigger="click">
                                <button class="btn btn-sm btn-secondary">
                                    更多<i class="el-icon-arrow-down el-icon--right"></i>
                                </button>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item v-if="user.id == question.user_id">
                                        <router-link :to="{name: 'questionEdit'}">编辑</router-link>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </div>
                        <div class="question-comments" v-if="is_comment">
                            <comment
                                    type="question"
                                    :model="question.id"
                            ></comment>
                        </div>
                        <div class="question-answer" v-if="is_answer">
                            <answer-create :question="question.id"></answer-create>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <answer-show></answer-show>
            </div>
        </div>
    </div>
</template>

<script>
    import AnswerCreate from '../answer/Create'
    import AnswerShow from  '../answer/Show'
    import Comment from '../comment/Comment'
    import {mapState} from 'vuex'
    import QuestionFollowButton from './QuestionFollowButton'
    import UserFollowButton from './UserFollowButton'
    import SendMessage from '../message/SendMessage'
    export default {
        name: "Show",
        components:{
            QuestionFollowButton,
            UserFollowButton,
            SendMessage,
            AnswerCreate,
            AnswerShow,
            Comment
        },
        data() {
            return {
                question: null,
                is_comment: false,
                is_answer: false,
            }
        },
        filters: {
            //将时间转化为Y-m-d
            formatDate: function (value) {
                let date = new Date(value);
                let y = date.getFullYear();
                let MM = date.getMonth() + 1;
                MM = MM < 10 ? ('0' + MM) : MM;
                let d = date.getDate();
                d = d < 10 ? ('0' + d) : d;
                return y + '-' + MM + '-' + d;
            }
        },
        computed:mapState({
            user: state=>state.AuthUser
        }),
        created(){
            axios.get('/api/questions/' + this.$route.params.id).then(response=>{
                this.$set(this, 'question', response.data.data)
            })
        }
    }
</script>

<style scoped>
    .jumbotron{
        background-color: #5cb860;
    }
    .media,.media-body{
        overflow: inherit;
        padding-top: 8px;
    }
    .rounded-circle{
        box-shadow: rgba(255,255,255,1) 0 0 0 3px,rgba(255,255,255,1) 0 0 1px 3px;
    }
    .media-conversation-replies a {
        font-weight: 700;
        display: block;
        text-align: center;
        color: #4B4B4B;
        font-size: 1.44em;
        line-height: 1;
        margin-bottom: -1px;
    }
    .media-body {
        margin-left: 20px;
    }
    .media-heading {
        color: #EB7347;
    }
    .post-topheader__info {
        margin-left: 0;
    }
    .mb15, .mb-15 {
        margin-bottom: 15px !important;
    }
    .post-topheader__info--title {
        margin: 0 0 10px 0;
        line-height: 1.2;
    }
    .taglist--inline, .taglist--block {
        list-style: none;
        padding: 0;
        font-size: 0;
    }
    .mr10, .mr-10 {
        margin-right: 10px !important;
    }
    .inline-block {
        display: inline-block;
    }
    ul, ol {
        margin-top: 0;
        margin-bottom: 10px;
    }
    .taglist--inline>li {
        display: inline-block;
        margin-right: 3px;
    }

    .taglist--inline li, .taglist--block li {
        padding: 0;
        font-size: 13px;
    }
    a.topic {
        background: #5cb860;
        padding: 1px 10px 0;
        border-radius: 30px;
        text-decoration: none;
        margin: 0 5px 5px 0;
        display: inline-block;
        white-space: nowrap;
        cursor: pointer;
    }
    a.topic:hover {
        background: lightskyblue;
        color: #fff;
        text-decoration: none;
    }
    .visit {
        margin-left: 20px;
    }
    .question-comments {
        margin-left: 20px;
        margin-top: 5px;
    }
    .question-answer {
        margin-top: 5px;
    }
</style>
