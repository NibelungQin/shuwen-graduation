<template>
    <div>
        <div class="feed-option">
            <div>
                <h5>
                    阅读热榜
                </h5>
            </div>
        </div>
        <div>
            <div class="recommend" v-for="article in articles">
                <router-link :to="'/articles/'+article.id">
                    {{article.title}}
                </router-link>
            </div>
            <div class="recommend" v-for="question in questions">
                <router-link :to="'/questions/'+question.id">
                    {{question.title}}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Recommend",
        data() {
            return {
                articles: [],
                questions: [],
            }
        },
        created(){
            axios.get('/api/home/recommend').then(response=>{
                this.articles = response.data.articles
                this.questions = response.data.questions
            })
        }
    }
</script>

<style scoped>
    .feed-option {
        margin-top: 15px;
        border-bottom: 1px solid #ddd;
    }
    .recommend {
        margin-top: 15px;
        color: #15b982;
    }
    .content{
        padding-left: 5px;
        /*margin-top: -8px;*/
    }
</style>