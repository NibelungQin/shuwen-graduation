<template>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 px-2 py-2 flex" v-for="article in articles" :key="article.id">
                    <router-link :to="'/articles/' + article.id">
                        <div class="article-list card" style="height: auto;">
                            <div class="white--text card__media" style="height: 200px;">
                                <div class="card__media__background"
                                     style="background: center center / cover no-repeat;"
                                     v-bind:style="{backgroundImage:'url(' + article.image + ')'}"
                                ></div>
                                <div class="card__media__content">
                                    <div class="container fill-height fluid">
                                        <div class="layout fill-height">
                                            <div class="flex xs12 align-end flexbox">
                                                <span class="headline">{{article.title}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card__title">
                                <p class="grey--text text-sm-left" style="width: 100%;">
                                    <span>{{article.created_at}}</span>
                                    <span style="float: right; margin-left: 10px;">
                                        <Icon type="md-eye" style="font-size: 10px;"/>
                                        &nbsp;&nbsp;{{article.view_count}}
                                    </span>
                                    <span style="float: right;">
                                        <Icon type="md-person" style="font-size: 10px;" />
                                        &nbsp;&nbsp;{{article.user.name}}
                                    </span>
                                </p>
                            </div>
                            <div class="extra content">
                                {{article.description}}
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
            <div class="text-xs-center" style="padding-top: 10px;">
                <Page :total="meta.total" :current="meta.current_page" :page-size="meta.per_page"
                      @on-change="handleCurrentChange" class="article-pagination"></Page>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                articles: [],
                page: 1,
                loading: false,
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
                var url = '/api/articles'
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
                    this.articles = response.data.data
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
    .flex {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
    }
    .py-2 {
        padding-top: 8px!important;
        padding-bottom: 8px!important;
    }
    .px-2 {
        padding-right: 8px!important;
    }
    .article-list {
        -webkit-transition: all 1s;
        transition: all 1s;
    }
    .card {
        display: block;
        border-radius: 2px;
        min-width: 0;
        position: relative;
        text-decoration: none;
        -webkit-box-shadow: 0 2px 1px -1px rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 3px 0 rgba(0,0,0,.12);
        box-shadow: 0 2px 1px -1px rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 3px 0 rgba(0,0,0,.12);
    }
    .card__media {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        overflow: hidden;
        position: relative;
    }
    .white--text {
        color: #fff!important;
    }
    .card__media__background {
        border-radius: inherit;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .card__media__content {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        position: relative;
    }
    .fill-height {
        height: 100%;
    }
    .container.fluid {
        max-width: 100%;
    }
    .fill-height {
        height: 100%;
    }
    .layout {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }
    .align-end {
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
    }
    .headline {
        font-size: 24px!important;
        font-weight: 400;
        line-height: 32px!important;
        letter-spacing: normal!important;
    }
    .card__title {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 16px;
    }
    .grey--text {
        color: #9e9e9e!important;
    }
    p {
        margin-bottom: 16px;
    }
    .icon {
        color: rgba(0,0,0,.54);
    }
    .extra {
        max-width: 100%;
        min-height: 0!important;
        -webkit-box-flex: 0;
        -ms-flex-positive: 0;
        flex-grow: 0;
        border-top: 1px solid rgba(0,0,0,.05)!important;
        position: static;
        background: none;
        width: auto;
        margin: 0;
        padding: 16px;
        top: 0;
        left: 0;
        color: rgba(0,0,0,.4);
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-transition: color .1s ease;
        transition: color .1s ease;
    }
    .content {
        -webkit-transition: none;
        transition: none;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        -ms-flex: 1 0 auto;
        flex: 1 0 auto;
        max-width: 100%;
        will-change: padding;
    }
    .text-xs-center {
        text-align: center!important;
    }
</style>