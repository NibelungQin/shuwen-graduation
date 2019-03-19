<template>
    <div class="PostStream-item">
        <article class="Post EventPost">
            <div class="action">
                <i class="EventPost-icon zi zi_comments"></i>
                <div class="EventPost-info">
                    <a class="EventPost-user">
                        <span class="username">共4条回复</span>
                    </a>
                </div>
            </div>
        </article>
        <comment-child></comment-child>
        <!--<div style="margin-top: 20px">-->
            <!--<div>-->
                <!--<div v-for="(comment,index) in comments">-->
                    <!--<div class="ui threaded comments trigger">-->
                        <!--<div class="flex comment md12">-->
                            <!--<a href="" class="avatar avatar-large">-->
                                <!--<img style="width: 40px" src="/images/avatars/matt-1.jpg">-->
                            <!--</a>-->
                            <!--<div class="comment_content">-->
                                <!--<a href="" class="author">qt</a>-->
                                <!--<div class="metadata">-->
                                    <!--<span class="date" style="font-weight: 700;">9个月前</span>-->
                                <!--</div>-->
                                <!--<div class="text Post-body">-->
                                    <!--<div style="margin-top: 2px;">-->
                                        <!--<div>-->
                                            <!--<div class="markdown">-->
                                                <!--<p>23333</p>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<div class="actions">-->
                                    <!--<a class="reply" @click="firstStep(index)">回复</a>-->
                                <!--</div>-->
                                <!--<div id="first-comment-reply" v-show="active===index">-->
                                    <!--<comment-reply></comment-reply>-->
                                <!--</div>-->
                                <!--<div style="margin-top: 20px;">-->
                                    <!--<div class="ui threaded comments trigger">-->
                                        <!--<div class="flex comment md12">-->
                                            <!--<a href="#" class="avatar avatar-large">-->
                                                <!--<img width="40px" src="/images/avatars/matt-1.jpg">-->
                                            <!--</a>-->
                                            <!--<div class="comment_content">-->
                                                <!--<a href="#" class="author">2456134825</a>-->
                                                <!--<span >回复-->
                                                    <!--<a href="#" class="author">king</a>-->
                                                <!--</span>-->
                                                <!--<div class="metadata">-->
                                                    <!--<span class="date" style="font-weight: 700;">1秒前-->
                                                    <!--</span>-->
                                                <!--</div>-->
                                                <!--<div class="text Post-body">-->
                                                    <!--<div style="margin-top: 2px;">-->
                                                        <!--<div>-->
                                                            <!--<div class="markdown">-->
                                                                <!--<p>11</p>-->
                                                            <!--</div>-->
                                                        <!--</div>-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="actions">-->
                                                    <!--<a v-if="user.id==1" class="reply"> 删除</a>-->
                                                    <!--<a v-else class="reply"> 回复</a>-->
                                                <!--</div>-->
                                                <!--<div id="second-comment-reply">-->
                                                    <!--<comment-reply></comment-reply>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</template>

<script>
    import CommentReply from './CommentReply'
    import CommentChild from './CommentChild'
    import {mapState} from 'vuex'
    export default {
        name: "PostComment",
        components: {
            CommentReply,
            CommentChild,
        },
        data() {
            return {
                comments: [1,2,3],
                active: -1,
                isShow: false,
            }
        },
        computed: {
            ...mapState({
                user:state=>state.AuthUser
            })
        },
        methods: {
            firstStep(index){
                this.active = index
            }
        }
    }
</script>

<style scoped>
    .PostStream-item {
        margin-top: 20px;
    }
    .EventPost, .EventPost a {
        color: #7089a9;
    }
    .Post {
        padding: 20px;
        margin: -1px -20px;
        position: relative;
        top: 0;
        border-radius: 4px;
        padding-left: 80px;
        border-bottom: 1px solid #e7edf3;
    }
    .EventPost-icon {
        text-align: right;
        margin-left: -85px;
        width: 64px;
        font-size: 22px;
        float: left;
    }
    .action {
        display: inline-block;
        font-family: Ionicons;
        speak: none;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        text-rendering: auto;
        line-height: 1;
    }
    .EventPost-info {
        font-size: 14px;
    }
    .EventPost a {
        font-weight: 700;
    }
    .ui.comments:first-child {
        margin-top: 0;
    }
    .ui.comments:last-child {
        margin-bottom: 0;
    }
    .ui.comments {
        font-size: 1em;
        margin: 1.5em 0;
        padding-bottom: 15px;
    }
    .comments {
        clear: both;
    }
    .ui.comments .comment :first-child {
        margin-top: 0;
        padding-top: 0;
    }
    .ui.comments .comment {
        position: relative;
        background: none;
        margin: .5em 0 0;
        padding: .5em 0 0;
        border: none;
        border-top: none;
        line-height: 1.2;
    }
    .flex {
        padding: 12px;
    }
    .avatar-large {
        width: 3.5em;
    }
    .ui.comments .comment .avatar {
        display: block;
        width: 3em;
        height: auto;
        float: left;
        margin: .2em 0 0;
    }
    a {
        cursor: pointer;
    }
    .avatar {
        align-items: center;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        position: relative;
        text-align: center;
        vertical-align: middle;
    }
    .comment_content {
        margin-left: 4.5em;
    }
    .author {
        font-size: 1em;
        color: #15b982;
        font-weight: 700;
    }
    .metadata {
        display: inline-block;
        margin-left: .5em;
        color: rgba(0,0,0,.4);
        font-size: .875em;
    }
    .text {
        margin: .25em 0 .5em;
        font-size: 1em;
        word-wrap: break-word;
        color: rgba(0,0,0,.87);
        line-height: 1.3;
    }
    .Post-body {
        font-size: 18px;
        line-height: 1.6;
        position: relative;
        overflow: auto;
    }
    .markdown {
        color: #636b6f;
        overflow: hidden;
        line-height: 2;
        word-wrap: break-word;
        font-size: 14px;
    }
    .actions {
        font-size: .9em;
        font-weight: 600;
    }
    .actions a {
        cursor: pointer;
        display: inline-block;
        margin: 0 .75em 0 0;
        color: rgba(0,0,0,.4);
    }
</style>
