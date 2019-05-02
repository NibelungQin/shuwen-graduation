<template>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <div class="padding-md">
                            <Menu active-name="1" theme="light" class="text-xs-center user-sidebar">
                                <router-link to="/" style="color: #495060;">
                                    <MenuItem name="1">
                                        <Icon type="md-time" />
                                        浏览记录
                                    </MenuItem>
                                </router-link>
                            </Menu>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default padding-md">
                        <div class="panel-body" style="font-size: 14px;color: #000;">
                            <h2><Icon type="md-time"></Icon> 我的记录</h2>
                            <hr>
                            <Timeline>
                                <TimelineItem v-for="read in reads" :key="read.id">
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
                                </TimelineItem>
                            </Timeline>
                            <div class="text-xs-center" style="padding-top: 10px;">
                                <Page :total="meta.total" :current="meta.current_page" :page-size="meta.per_page"
                                      @on-change="handleCurrentChange" class="article-pagination"></Page>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ArticleLog from './ArticleRead'
    import QuestionLog from './QuestionRead'
    export default {
        name: "ReadLog",
        components: {
            ArticleLog,
            QuestionLog,
        },
        data() {
            return {
                reads: [],
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
                var url = '/api/reads'
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
                    this.reads = response.data.data
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
        padding: 25px 0!important;
        /*background: #f5f5f1!important;*/
    }
    .ivu-menu-light.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu) {
        color: #fff!important;
        background-color: rgb(26, 188, 156) !important;
        z-index: 2;
        border-right: none !important;
    }
    .ivu-menu-vertical.ivu-menu-light:after{
        display: none !important;
    }
    .ivu-menu.user-sidebar{
        width: 100% !important;
    }
    .ivu-menu-vertical .ivu-menu-item:hover, .ivu-menu-vertical .ivu-menu-submenu-title:hover {
        background: rgb(26, 188, 156) !important;
        color: #fff !important;
    }
    .box {
        background-color: #fff;
        padding: 10px;
        margin: 0 0 20px 0;
        -webkit-box-shadow: 0 0.2em 0 0 #ddd, 0 0 0 1px #ddd;
        box-shadow: 0 0.2em 0 0 #ddd, 0 0 0 1px #ddd;
    }
    .padding-md {
        padding: 15px;
    }
    .panel{
        border-radius: 0px;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid #dde2e8;
        margin-bottom: 20px;
        background-color: #fff;
    }
    .panel .panel-heading, .panel .panel-body {
        border: none;
        padding: 15px;
    }
    .panel-body h2{
        color: #495060 !important;
    }
    .content{
        padding-left: 5px;
        /*margin-top: -8px;*/
    }
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #e4e4e4;
    }
    .text-xs-center {
        text-align: center!important;
    }
</style>