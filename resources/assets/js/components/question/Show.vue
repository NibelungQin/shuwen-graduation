<template>
    <div>
        <div class="jumbotron">
            <div class="container">
                <div class="media">
                    <div>
                        <a href="#">
                            <img class="rounded-circle" :src="question.user.avatar" alt="64x64" style="height: 64px ;width: 64px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">{{question.user.name}}</h6>
                        <h6>{{question.created_at | ago()}} 提问</h6>
                        <div class="">
                            <question-follow-button :question="question.id"></question-follow-button>
                            <button class="btn btn-dark btn-sm">收藏</button>
                            <span>评论</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9" role="main">
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import QuestionFollowButton from './QuestionFollowButton'
    export default {
        name: "Show",
        components:{
            QuestionFollowButton
        },
        data() {
            return {
                question: null,
            }
        },
        filters: {
            //将时间转化为Y-m-d
            ago (date) {
                var d = new Date(date);
                return d.getFullYear()+ '-' + (d.getMonth()+1)+ '-' +d.getDate();
            }
        },
        computed:mapState({
            user: state=>state.AuthUser
        }),
        created(){
            axios.get('/api/questions/' + this.$route.params.id).then(response=>{
                this.question = response.data.data
            })
        }
    }
</script>

<style scoped>
    .jumbotron{
        background-color: #AEDD81;
        margin-bottom: 20px;
        color: black;
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
</style>
