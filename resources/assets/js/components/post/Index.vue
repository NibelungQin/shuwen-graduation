<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div v-for="question in questions">
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img class="rounded-circle" width="50" :src="question.user.avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4>
                                <router-link :to="{name: 'questionShow', params: {id: question.id}}">
                                    {{question.title}}
                                </router-link>
                            </h4>
                            <div v-html="question.body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block">
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page.sync="page"
                    :page-size="10"
                    layout="prev, pager, next, jumper"
                    :total="count">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                questions:[],
                page: 0,
                count: 0,
            }
        },
        mounted(){
            axios.get('/api/questions',{'page': this.page}).then(response=>{
                this.questions = response.data.questions
                this.count = response.data.count
                window.Echo.channel('questions')
                    .listen('QuestionCreated',e=>{
                        this.questions.push(e.question)
                    })
            })
        }
    }
</script>

<style scoped>

</style>
