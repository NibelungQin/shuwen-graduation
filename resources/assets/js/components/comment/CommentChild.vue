<template>
    <div class="ui threaded comments trigger">
        <div md12 class="comment">
            <router-link :to="'/users/' + comment.reply_user.name" class="avatar avatar-large" v-if="comment['reply_user']">
                <img width="60px" :src="comment['reply_user'].avatar" class="b-lazy b-loaded">
            </router-link>
            <router-link :to="'/users/' + comment.user.name" class="avatar avatar-large"  v-else>
                <img width="60px" :src="comment['user'].avatar" class="b-lazy b-loaded">
            </router-link>
            <div class="comment_content">

                <router-link :to="'/users/' + comment['reply_user'].name" class="author">{{ comment['reply_user'].name }}</router-link>

                <span v-if="comment['parent_id']">
                    回复 <router-link :to="'/users/' + comment['user'].name" class="author">{{ comment['user'].name }}</router-link>
                </span>

                <div class="metadata">
                    <span class="date" style="font-weight: 700;">
                    {{ comment.created_at }}
                    </span>
                </div>
                <div class="text Post-body">
                    <div style="margin-top: 2px;">
                        <div>
                            <div class="markdown" v-html="comment.body"></div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <a class="reply" v-if="get_is_show_reply()" @click="show_relpy">
                        回复
                    </a>
                    <a class="reply" v-if="get_is_show_delete()" @click="show_delete(comment_key)">
                        删除
                    </a>
                </div>

                <div v-show="is_show" style="margin-top: 10px;">
                    <Form>
                        <FormItem>
                            <Input v-model="comment_content" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..."></Input>
                        </FormItem>
                        <FormItem>
                            <Button type="primary" @click="post_comment">立即回复</Button>
                            <Button type="warning" @click="show_relpy()" style="margin-left: 8px">取消回复</Button>
                        </FormItem>
                    </Form>
                </div>
                <div v-if="is_follow() && show_level < 2">
                    <comment-root :commentable_id="commentable_id" :canComment="canComment" :user_id="user_id" :commentable_type="commentable_type" :collections="get_child_list()" :comments="real_comments"></comment-root>
                </div>
            </div>
            <div v-if="is_follow() && show_level >= 2">
                <comment-root :canComment="canComment" :commentable_id="commentable_id" :user_id="user_id" :commentable_type="commentable_type" :collections="get_child_list()" :comments="real_comments"></comment-root>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CommentChild',
        props:['comment','comments','user_id','commentable_id', 'commentable_type', 'canComment', 'comment_key'],
        data() {
            return {
                show_level: this.comment.level,
                is_show:false,
                comment_content:'',
                real_comments:this.comments,
            }
        },
        methods: {
            show_relpy(){
                this.is_show=!this.is_show;
            },
            is_follow(){
                if(typeof(this.comments[this.comment.id])=='undefined'){
                    return false;
                }
                return true;
            },
            get_child_list(){
                return this.comments[this.comment.id];
            },
            get_is_show_reply(){
                if (this.canComment) {
                    if (this.comment['reply_user']) {
                        return this.user_id != this.comment['reply_user'].id
                    }

                    return this.user_id != this.comment['user'].id;
                }
                return false
            },
            get_is_show_delete() {
                if (this.canComment) {
                    if (this.comment['reply_user']) {
                        return this.user_id == this.comment['reply_user'].id
                    }

                    return this.user_id == this.comment['user'].id;
                }
                return false
            },
            show_delete(comment_key) {
                this.$Modal.confirm({
                    title: '删除该评论?',
                    content: '该评论下的所有子评论会被删除!',
                    okText: '确定',
                    cancelText: '取消',
                    onOk: () => {
                        axios.delete('/api/comments/' + this.comment.id).then((response) => {
                            if(typeof(this.real_comments['' + this.comment.parent_id]) != 'undefined'){
                                this.real_comments[this.comment.parent_id].splice(comment_key, 1);
                            } else {
                                this.real_comments['root'].splice(comment_key, 1);
                            }
                        });
                    },
                });

            },
            post_comment(){
                if (! this.comment_content) {
                    this.$Message.error('请输入评论内容!');
                    return false;
                }
                let data = {
                    parent_id : this.comment.id,
                    body : this.comment_content,
                    commentable_id: this.commentable_id,
                    commentable_type: this.commentable_type,
                }
                axios.post('/api/comment',data).then((response) => {
                    this.comment_content = '';
                    this.is_show = !this.is_show;
                    if(typeof(this.real_comments[''+response.data.parent_id])!='undefined'){
                        this.real_comments[response.data.parent_id].push(response.data);
                    }else{
                        this.real_comments[this.comment.id]=new Array();
                        this.real_comments[this.comment.id].push(response.data);
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .ui.comments:last-child {
        margin-bottom: 0;
    }
    .ui.comments:first-child {
        margin-top: 0;
    }
    .ui.comments {
        font-size: 1em;
    }
    .ui.comments {
        margin: 1.5em 0;
        padding-bottom: 15px;
    }
    .comments {
        clear: both;
    }
    .ui.comments .comment:first-child {
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
    .ui.comments .comment .avatar.avatar-large {
        width: 3.5em;
    }
    .ui.comments .comment .avatar {
        display: block;
        width: 3em;
        height: auto;
        float: left;
        margin: .2em 0 0;
    }
    .ui.comments .comment .avatar img, .ui.comments .comment img.avatar {
        display: block;
        margin: 0 auto;
        width: 100%;
        height: 100%;
        border-radius: .25rem;
    }
    .ui.comments .comment>.avatar.avatar-large~.comment_content {
        margin-left: 4.5em;
    }
    .ui.comments .comment a.author:hover {
        color: #15b982;
    }
    .ui.comments .comment a.author {
        cursor: pointer;
    }
    .ui.comments .comment .author {
        font-size: 1em;
        color: #15b982;
        font-weight: 700;
    }
    .ui.comments .comment .metadata {
        display: inline-block;
        margin-left: .5em;
        color: rgba(0, 0, 0, .4);
        font-size: .875em;
    }
    .ui.comments .comment .metadata>* {
        display: inline-block;
        margin: 0 .5em 0 0;
    }
    .ui.comments .comment .text {
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
    .ui.comments .comment .actions {
        font-size: .9em;
        font-weight: 600;
    }
    .ui.comments .comment .actions a {
        cursor: pointer;
        display: inline-block;
        margin: 0 .75em 0 0;
        color: rgba(0,0,0,.4);
    }
</style>