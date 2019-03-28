<template>
    <main class="main-content">
        <div class="content--wrap">
            <div class="container">
                <div class="col-md-10 offset-md-1" v-if="article">
                    <h1 class="article-title">{{article.title}}</h1>
                    <div class="meta">
                        <div class="user-card">
                            <a href="">
                                <img class="rounded-circle" :src="article.user.avatar" alt="64x64" style="height: 30px ;width: 30px">
                            </a>
                            <h4>
                                <router-link :to="'/users/' + article.user.name" class="" style="color: rgb(21, 185, 130);">{{article.user.name}}</router-link>
                            </h4>
                            <time style="vertical-align: middle; font-size: 12px; color: rgb(155, 155, 155);">发表于 {{article.created_at | ago()}}</time>
                        </div>
                        <div class="actions">
                            <i class="zi zi_eye"></i>
                            {{article.view_count}}次浏览
                        </div>
                        <div class="actions">
                            <i class="zi zi_tag"></i>
                            <a v-for="topic in article.topics">{{topic.name}} </a>
                        </div>
                    </div>
                    <div class="card" style="height: auto">
                        <div class="card__text markdown elevation-8" style="padding: 15px 20px 1px 30px">
                            <div class="showbody" v-html="article.content"></div>
                        </div>
                    </div>
                    <div class="">
                        <post-comment></post-comment>
                    </div>
                    <div>
                        <submit-comment></submit-comment>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import moment from 'moment'
    import PostComment from  '../comment/PostComment'
    import SubmitComment from '../comment/SubmitComment'
    import {mapState} from 'vuex'
    export default {
        name: "Show",
        components:{
            PostComment,
            SubmitComment
        },
        data() {
            return {
                article: null,
                is_comment: false,
                is_answer: false,
            }
        },
        filters: {
            //过滤时间距离更新时间有多久
            ago (time) {
                return moment(time).fromNow()
            }
        },
        computed: {
            ...mapState({
                user: state=>state.AuthUser
            })
        },
        created(){
            axios.get('/api/articles/' + this.$route.params.id).then(response=>{
                this.$set(this, 'article', response.data)
            })
        }
    }
</script>

<style scoped>
    .main-content {
        padding: 25px 0!important;
        background: #f5f5f1!important;
    }
    .content--wrap {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        max-width: 100%;
    }
    .article-title {
        font-size: 32px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 12px;
    }
    .meta {
        margin-bottom: 15px;
        margin-top: 10px;
        text-align: center;
    }
    .user-card {
        display: inline-block;
        margin-right: 15px;
    }
    .user-card h4 {
        display: inline;
        vertical-align: middle;
        margin-right: 8px;
        font-weight: 400;
        margin: 0 10px 0 0;
        font-size: 14px;
        line-height: 1.66666667;
        margin-right: 20px;
    }
    .actions {
        display: inline-block;
        margin-right: 5px;
    }
    .actions a {
        font-size: 12px;
        margin-right: 5px;
        color: #9b9b9b;
    }
    .markdown {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        color: #636b6f;
        overflow: hidden;
        line-height: 2;
        word-wrap: break-word;
        font-size: 14px;
    }
    .card__text {
        padding: 16px;
        width: 100%;
    }
    .elevation-8 {
        -webkit-box-shadow: 0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)!important;
        box-shadow: 0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)!important;
    }
</style>
<style>
    .showbody img {
        width: 100%;
    }
</style>
