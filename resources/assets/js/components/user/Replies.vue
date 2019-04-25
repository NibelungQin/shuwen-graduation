<template>
    <div>
        <div v-if="comments">
            <div class="section__3bS4" v-for="(comment, index) in comments">
                <div style="padding: 10px 0">
                    <router-link v-if="comment.commentable_type == 'App\\Model\\Question'" :to="'/questions/' + comment.commentable.id">{{ comment.commentable.title}}</router-link>
                    <router-link v-else :to="'/articles/' + comment.commentable.id">{{ comment.commentable.title}}</router-link>
                    <span class="meta" style="color: #a9a7a7;font-size: 12px;">&nbsp;&nbsp;<span class="timeago">{{ comment.created_at}}</span></span>
                </div>
                <div style="padding: 10px 0" v-if="comment.reply_user">
                    <span class="meta" style="color: #a9a7a7;font-size: 12px;">回复</span><router-link :to="'/users/' + comment.user.name">{{ comment.user.name }}</router-link> :
                </div>
                <div class="markdown" v-html="comment.body"></div>
            </div>
            <div class="comment-page">
                <Page size="small" show-total :total="meta.total" :current="meta.current_page" :page-size="meta.per_page"
                      @on-change="handleCurrentChange"></Page>
            </div>
        </div>
        <div style="text-align: center" v-else>
            <img src="/images/comment.png">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                question: 'App\Model\Question',
                comments: [],
                meta: {
                    total: 0,
                    current_page: 1,
                    per_page: 0
                }
            }
        },
        watch: {
            '$route' (to, from) {
                this.loadData()
            }
        },
        created() {
            this.loadData()
        },
        methods: {
            loadData() {
                var url = '/api/users/' + this.$route.params.name + '/replies';
                if (this.meta.current_page > 1) {
                    let page = ''
                    if (url.indexOf('?') != -1) {
                        page = '&page='
                    } else {
                        page = '?page='
                    }
                    url = url + page + this.meta.current_page
                    this.$router.push(page + this.meta.current_page)
                }
                axios.get(url).then((response) => {
                    this.comments = response.data.data
                    this.meta = response.data.meta
                })
            },
            handleCurrentChange(val) {
                this.meta.current_page = val
                this.loadData()
            },
            settingActive() {
                this.$emit('active', this.$route.name)
            }
        }
    }
</script>

<style lang="less">
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
    .comment-page{
        padding:20px;
        text-align:right;
        color: #5a5a5a;
    }
</style>