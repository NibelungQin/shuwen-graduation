<template>
    <div class="main-content">
        <div class="container" style="height: calc(100% - 50px);">
            <div class="row">
                <div class="col-md-12">
                    <div class="section__3bS4" v-for="(question, index) in questions">
                        <div style="padding: 10px 0">
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img class="rounded-circle" width="60" :src="question.user.avatar">
                                    </a>
                                </div>
                                <div class="media-body" style="margin-left: 10px">
                                    <h4>
                                        <router-link :to="{name: 'questionShow', params: {id: question.id}}">
                                            {{question.title}}
                                        </router-link>
                                    </h4>
                                    <div class="float-right">
                                        <span class="media-conversation-replies">
                                            <a href="#">{{question.answers_count}}</a>
                                                回复
                                        </span>
                                    </div>
                                    <div>
                                        {{question.user.name}}
                                        {{question.created_at}}提问
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-xs-center" style="padding-top: 10px;">
            <Page :total="meta.total" :current="meta.current_page" :page-size="meta.per_page"
                  @on-change="handleCurrentChange"></Page>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                questions:[],
                page: 1,
                meta: {
                    total: 0,
                    current_page: 1,
                    per_page: 0
                }
            }
        },
        created() {
            this.loadData()
        },
        methods: {
            loadData(){
                var url = '/api/questions'
                if (this.meta.current_page > 1){
                    let page = ''
                    if (url.indexOf('?') != -1){
                        page = '&page='
                    }else {
                        page = '?page='
                    }
                    url = url + page + this.meta.current_page
                    this.$router.push(page + this.meta.current_page)
                }

                axios.get(url).then(response=>{
                    this.questions = response.data.data
                    this.meta = response.data.meta
                })
            },
            handleCurrentChange(val) {
                this.meta.current_page = val
                this.loadData()
            },
        }
    }
</script>

<style scoped>
    .main-content {
        height: 100%;
        padding: 25px 0!important;
        background: #f5f5f1!important;
    }
    .section__3bS4 {
        padding: 10px 15px;
        border: none;
        margin-bottom: 0px;
        border-bottom: 1px solid #f2f2f2;
    }
    .section__3bS4 a {
        color: #15b982;
    }
    .meta, .operate {
        color: #a9a7a7;
        font-size: 12px;
    }
    .text-xs-center {
        text-align: center!important;
    }
</style>
