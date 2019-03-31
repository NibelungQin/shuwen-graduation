<template>
    <div class="PostStream-item">
        <article class="Post EventPost DiscussionStickiedPost">
            <div>
                <Icon type="md-chatbubbles" class="EventPost-icon"></Icon>
                <div class="EventPost-info">
                    <a class="EventPost-user">
                        <span class="username">共{{ comment_count }}条回复</span>
                    </a>
                </div>
            </div>
        </article>

        <comment-root :commentable_id="commentableId" :canComment="canComment" :user_id="user_id" :comments="comments" :commentable_type="commentableType" :collections="root"></comment-root>

        <div v-if="! canComment">
            <button class="btn btn-block" style="background-color:#F96854 !important;color: #fff !important;">登陆发表评论</button>
        </div>
        <div v-else>
            <Form>
                <FormItem>
                    <Input v-model="comment_content" type="textarea" :autosize="{minRows: 2,maxRows: 5}"placeholder="请填写您的评论"></Input>
                </FormItem>
                <FormItem>
                    <Button type="primary" @click="post_comment">提交评论</Button>
                </FormItem>
            </Form>
        </div>

    </div>
</template>
<script>
    export default{
        props: {
            commentableId: {
                type: Number,
            },
            commentableType: {
                type: String,
                default() {
                    return 'article'
                }
            },
            user_id: {
                type: Number
            },
            canComment: {
                type: Boolean,
                default() {
                    return false
                }
            },
        },
        data(){
            return{
                comment_content:'',
                comments: {},//评论分组
                root: [],//父评论 一级评论
                comment_count: 0
            }
        },
        created() {
            //获取评论内容
            axios.get('/api/commentable/' + this.commentableId + '/comment',{params: {'type': this.commentableType}}).then(response=>{
                this.comments = response.data
                if(typeof(response.data.root) != 'undefined'){
                    this.root = response.data.root
                }
                this.comment_count = response.data.count
            })
        },
        methods:{
            post_comment(){
                if (! this.comment_content) {
                    this.$Message.error('请输入评论内容!');
                    return false;
                }
                const data = {
                    body: this.comment_content,
                    commentable_id: this.commentableId,
                    commentable_type: this.commentableType,
                }
                axios.post('/api/comment', data).then((response) => {
                    console.log(this.root);
                    this.root.push(response.data);
                    this.comment_content = '';
                    this.comment_count++
                })
            },
        },
    }
</script>

<style scoped lang="less">
    .PostStream-item{
        margin-top:20px;
    }
    .Post {
        padding: 20px;
        margin: -1px -20px;
        -webkit-transition: box-shadow .2s,top .2s,opacity .2s;
        transition: box-shadow .2s,top .2s,opacity .2s;
        position: relative;
        top: 0;
        border-radius: 4px;
        padding-left: 80px;
        border-bottom: 1px solid #e7edf3;
    }
    .EventPost, .EventPost a {
        color: #7089a9;
    }
    .Post:after, .Post:before {
        content: " ";
        display: table;
    }
    .EventPost-info {
        font-size: 14px;
    }
    .EventPost a {
        font-weight: 700;
    }
    .EventPost, .EventPost a {
        color: #7089a9;
    }
    .EventPost-icon {
        text-align: right;
        margin-left: -85px;
        width: 64px;
        font-size: 22px;
    }
    .EventPost-icon {
        float: left;
    }
</style>
