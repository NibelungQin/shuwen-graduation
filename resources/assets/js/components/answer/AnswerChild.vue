<template>
    <div class="media">
        <div>
            <user-vote-button :answer="answer.id" :number="answer.votes_count"></user-vote-button>
        </div>
        <div class="media-body" style="margin-left: 10px">
            <span v-html="answer.body" class="markdown"></span>
            <div>
                <div class="float-left">
                    <a @click="show_answer" style="color: #3f9ae5"><Icon type="md-chatboxes" />评论</a>
                </div>
                <div class="float-right">
                    <div class="media float-right">
                        <div>
                            <router-link :to="'/users/' + answer.user.name">
                                <img class="rounded-circle" :src="answer.user.avatar" alt="64x64" style="height: 40px ;width: 40px">
                            </router-link>
                        </div>
                        <div>
                            <div class="media-body" style="margin-left: 10px">
                                <router-link :to="'/users/' + answer.user.name" class="author">{{answer.user.name}}</router-link>

                                <p>{{answer.created_at | ago()}}回答</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="is_show">
                <comment-post :canComment="canComment" :user_id="user_id" :username="username" :commentableId="answer.id" :commentableType="commentableType"></comment-post>
            </div>
        </div>
    </div>
</template>

<script>
    import UserVoteButton from '../vote/UserVoteButton'
    import moment from 'moment'
    export default {
        name: "AnswerChild",
        components: {
            UserVoteButton,
        },
        props:['answer','canComment','user_id','username'],
        data() {
            return {
                is_show: false,
            }
        },
        filters: {
            //过滤时间距离更新时间有多久
            ago (time) {
                return moment(time).fromNow()
            }
        },
        computed: {
            commentableType(){
                return 'answer'
            }
        },
        methods: {
            show_answer(){
                this.is_show=!this.is_show;
            }
        },
    }
</script>

<style scoped>
    .markdown {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        color: #636b6f;
        overflow: hidden;
        line-height: 2;
        word-wrap: break-word;
        font-size: 14px;
    }
    a.author:hover {
        color: #15b982;
    }
    a.author {
        cursor: pointer;
    }
    .author {
        font-size: 1em;
        color: #15b982;
        font-weight: 700;
    }
</style>