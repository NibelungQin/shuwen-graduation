<template>
    <v-app>
    <v-content class="main-content">
        <v-container id="article">
            <v-layout row wrap>
                <v-flex md4 v-for="article in articles" :key="article.id" class="px-2 py-2">
                    <router-link :to="'/articles/' + article.id">
                        <v-card class="article-list">
                            <v-img
                                    class="white--text"
                                    height="200px"
                                    :src="article.image"
                            >
                                <v-container fill-height fluid>
                                    <v-layout fill-height>
                                        <v-flex xs12 align-end flexbox>
                                            <span class="headline">{{ article.title }}</span>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-img>
                            <v-card-title>
                                <p class="grey--text text-sm-left" style="width:100%">
                                    <span>{{ article.published_at }}</span>
                                    <span style="float:right;margin-left: 10px;"><v-icon size="10px">fas fa-eye</v-icon>&nbsp;&nbsp;{{ article.view_count }}</span>
                                    <!--<span style="float:right;"><v-icon size="10px">fas fa-user</v-icon>&nbsp;&nbsp;{{ article.user.nickname ? article.user.nickname : article.user.name }}</span>-->
                                </p>
                            </v-card-title>
                            <div class="extra content">
                                {{ article.description }}
                            </div>
                        </v-card>
                    </router-link>
                </v-flex>
            </v-layout>
            <!--<div class="text-xs-center" style="padding-top: 10px;">-->
                <!--<Page :total="meta.total" :current="meta.current_page" :page-size="meta.per_page"-->
                      <!--@on-change="handleCurrentChange" class="article-pagination"></Page>-->
            <!--</div>-->
        </v-container>
    </v-content>
    </v-app>
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
            axios.get('/api/articles',{'page': this.page}).then(response=>{
                this.articles = response.data.data
                // this.count = response.data.count
                // window.Echo.channel('questions')
                //     .listen('QuestionCreated',e=>{
                //         this.questions.push(e.question)
                //     })
            })
        },
        // methods: {
        //     loadData() {
        //         var url = 'articles';
        //         if (this.meta.current_page > 1) {
        //             let page = ''
        //             if (url.indexOf('?') != -1) {
        //                 page = '&page='
        //             } else {
        //                 page = '?page='
        //             }
        //             url = url + page + this.meta.current_page
        //             this.$router.push(page + this.meta.current_page)
        //         }
        //         this.$http.get(url).then((response) => {
        //             this.articles = response.data;
        //             this.meta = response.meta
        //         })
        //     },
        //     handleCurrentChange(val) {
        //         this.meta.current_page = val
        //         this.loadData()
        //     },
        // }
    }
</script>

<style lang="css" scoped>
    @import '~vuetify/dist/vuetify.min.css';
</style>