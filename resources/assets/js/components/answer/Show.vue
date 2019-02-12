<template>
    <div>
        <span><h3>{{this.pagination.total}}个回答</h3></span>
        <div class="card-footer">
            <ul v-for="answer in answers" v-bind:key="answer.id">
                <li>
                    <div class="media">
                        <div>
                            <user-vote-button :answer="answer.id" :number="answer.votes_count"></user-vote-button>
                        </div>
                        <div class="media-body">
                            <span v-html="answer.body"></span>
                            <div>
                                <div class="answer-left">
                                    <el-button
                                            type="text"
                                            icon="el-icon-edit"
                                            @click="is_comment=!is_comment"
                                    >评论 {{Object.keys(answer.comments).length}}</el-button>
                                </div>
                                <div class="answer-right">
                                    <div class="media float-right">
                                        <div>
                                            <img class="rounded-circle" :src="answer.user.avatar" alt="64x64" style="height: 40px ;width: 40px">
                                        </div>
                                        <div>
                                            <div class="media-body">
                                                {{answer.user.name}}
                                                <p>{{answer.user.created_at | ago}} 回答</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="answer-comments" v-bind:key="answer.id" v-if="is_comment">
                                    <comment
                                        type="answer"
                                        :model="answer.id"
                                    ></comment>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="more">
                <el-button type="text" @click="more">
                    加载更多
                    <i class="el-icon-caret-bottom el-icon--right"></i>
                </el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import UserVoteButton from '../vote/UserVoteButton'
    import Comment from '../comment/Comment'
    export default {
        name: "Show",
        components: {
            UserVoteButton,
            Comment
        },
       data() {
            return {
                pagination: {
                    total: 0,
                    per_page: 10,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page:0
                },
                is_comment: false,
                count: 1,
                answers: [],
            }
       },
        filters: {
            //将时间转化为Y-m-d
            ago (date) {
                var d = new Date(date);
                return d.getFullYear()+ '-' + (d.getMonth()+1)+ '-' +d.getDate();
            }
        },
        mounted() {
            this.fetchAnswers(this.pagination.current_page);
        },
        methods: {
            fetchAnswers(page){
                let data = {page: page}
                axios.get('/api/questions/' + this.$route.params.id + '/answer', data).then(response=>{
                    this.$set(this, 'answers', response.data.data.data)
                    this.$set(this, 'pagination', response.data.pagination)
                })
            },
            more(){
                this.count++
                if (this.pagination.last_page>=this.count) {
                    axios.get('/api/questions/' + this.$route.params.id + '/answer?page=' + this.count).then(response=>{
                        this.answers = this.answers.concat(response.data.data.data)
                        this.$set(this, 'pagination', response.data.pagination)
                    })
                }else {
                    this.$notify({
                        title: '没有更多的数据',
                        position: 'bottom-right'
                    });
                }
            },
        }
    }
</script>

<style scoped>
    .media,.media-body{
        overflow: inherit;
    }
    .media-body {
        margin-left: 10px;
    }
    li {
        display: inline-block;
        margin-left: -40px;
    }
    .answer-left {
        display: inline;
    }
    .answer-right {
        display: inline;
    }
    .answer-comments {
        margin-left: 20px;
        margin-top: 5px;
    }
    .more {
        margin-left: auto;
        margin-right: auto;
    }
</style>
