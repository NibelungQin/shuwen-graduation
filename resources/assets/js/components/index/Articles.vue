<template>
    <div class="article">
        <div class="feed-option">
            <div>
                <h5>
                    最新文章
                    <router-link :to="'/articles'" class="float-right">更多</router-link>
                </h5>
            </div>
        </div>
        <div class="aa" v-for="article in articles">
            <router-link :to="'/articles/'+article.id">
                <div class="news__item-info">
                    <img :src="article.image" alt="" class="new-img">
                    <div class="mb5 mt5">
                        <h4 class="news__item-title">{{article.title}}</h4>
                    </div>
                    <div class="article-excerpt">{{article.description}}</div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Articles",
        data() {
            return {
                articles: [],
            }
        },
        created(){
            axios.get('/api/home/articles').then(response=>{
                this.articles = response.data
            })
        }
    }
</script>

<style scoped>
    .feed-option {
        margin-top: 15px;
        border-bottom: 1px solid #ddd;
    }
    .aa {
        margin-top: 15px;
    }
    .news__item-info {
        padding: 0 0 15px 0;
        color: #9E9E9E;
        font-size: 14px;
    }
    .new-img {
        width: 80px;
        height: 60px;
        border-radius: 4px;
        float: left;
        background-size: cover;
        background-position: center;
    }
    .news__item-title {
        display: inline;
        font-weight: 500;
        font-size: 18px;
        line-height: 28px;
        color: #212121;
        position: relative;
        vertical-align: middle;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .article-excerpt {
        margin-bottom: 15px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.5;
        color: #888;
        font-size: 13px;
        font-family: -apple-system, BlinkMacSystemFont, Helvetica Neue, PingFang SC, Microsoft YaHei, Source Han Sans SC, Noto Sans CJK SC, WenQuanYi Micro Hei, sans-serif;
    }
</style>