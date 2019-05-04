<template>
    <div>
        <div class="feed-option">
            <div>
                <h5>
                    浏览记录
                </h5>
            </div>
        </div>
        <div class="reads" v-for="read in reads" :key="read.id">
            <div class="content" v-if="read.type == 'Article'">
                <article-log
                        :id="read.readable.id"
                        :title="read.readable.title"
                        :created_diff="read.created_diff"
                ></article-log>
            </div>
            <div class="content" v-if="read.type == 'Question'">
                <question-log
                        :id="read.readable.id"
                        :title="read.readable.title"
                        :created_diff="read.created_diff"
                ></question-log>
            </div>
        </div>
    </div>
</template>

<script>
    import ArticleLog from '../readlog/ArticleRead'
    import QuestionLog from '../readlog/QuestionRead'
    export default {
        name: "ReadLog",
        components: {
            ArticleLog,
            QuestionLog,
        },
        data() {
            return {
                reads: [],
            }
        },
        created() {
            axios.get('/api/home/reads').then(response=>{
                this.reads = response.data
            })
        }
    }
</script>

<style scoped>
    .feed-option {
        margin-top: 15px;
        border-bottom: 1px solid #ddd;
    }
    .reads {
        margin-top: 15px;
    }
    .content{
        padding-left: 5px;
        /*margin-top: -8px;*/
    }
</style>