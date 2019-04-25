<template>
    <div class="PostStream-item">
        <article class="Post EventPost DiscussionStickiedPost">
            <div>
                <Icon type="md-clipboard" class="EventPost-icon"></Icon>
                <div class="EventPost-info">
                    <a class="EventPost-user">
                        <span class="username">共{{answer_count}}个回答</span>
                    </a>
                </div>
            </div>
        </article>
        <div style="margin-top: 20px;">
            <div style="margin: 10px" v-for="(answer,key) in answers">
                <answer-child :canComment="canComment" :user_id="user_id" :username="username" :answer="answer"></answer-child>
            </div>
        </div>
        <div v-if="! canComment">
            <button class="btn btn-block" style="background-color:#F96854 !important;color: #fff !important;">登陆发表评论</button>
        </div>
        <div v-else>
            <Form>
                <FormItem>
                    <Input v-model="answer_body" type="textarea" :autosize="{minRows: 2,maxRows: 5}"placeholder="请填写您的答案"></Input>
                </FormItem>
                <FormItem>
                    <Button type="primary" @click="post_answer">提交答案</Button>
                </FormItem>
            </Form>
        </div>
    </div>
</template>

<script>
    import AnswerChild from './AnswerChild'
    export default {
        name: "Show",
        components: {
            AnswerChild
        },
        props: ['answerCount','canComment','user_id','username'],
        data() {
            return {
                answers: [],
                answer_body: '',
                is_show: false,
                answer_count: this.answerCount
            }
        },
        mounted() {
            axios.get('/api/questions/' + this.$route.params.id + '/answer').then(response=>{
                this.answers = response.data
            })
        },
        methods: {
            post_answer(){
                if (! this.answer_body) {
                    this.$Message.error('请输入答案内容!');
                    return false;
                }
                const data = {
                    body: this.answer_body,
                    user_id: this.user_id,
                    question_id: this.$route.params.id,
                }
                axios.post('/api/questions/' + this.$route.params.id + '/answer', data).then((response) => {
                    this.answers.push(response.data.data);
                    this.answer_body = '';
                    this.answer_count++
                })
            }
        }
    }
</script>

<style scoped>
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
