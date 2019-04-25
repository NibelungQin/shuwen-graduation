<template>
    <div class="col-md-6 list">
        <li @click="getBook()">
            <img :src="imgUrl">
            <div class="book-info">
                <p class="book-title">{{book.title}}</p>
                <p class="book-author">{{book.author}} | {{book.majorCate}}</p>
                <p class="short-intro">{{book.shortIntro}}</p>
                <p class="reader-info">{{latelyFollower}}万人气 | {{book.retentionRatio}}%读者留存</p>
            </div>
        </li>
    </div>
</template>

<script>
    import {SHUWEN_CONFIG} from "../../config";

    export default {
        name: 'Bookslist',
        data () {
            return {

            }
        },
        props: ['book'],
        computed: {
            latelyFollower () {
                return (this.book.latelyFollower / 10000).toFixed(1)
            },
            imgUrl () {
                return SHUWEN_CONFIG.NOVEL_COVER_URL + this.book.cover
            }
        },
        methods: {
            getBook () {
                // 只记录从不是搜索结果中进入书本详情的路径，不然会出现死循环
                // if(this.$route.path.indexOf('/search') === -1){
                //     this.$store.commit('setPrePath', this.$route.fullPath);
                // }
                this.$router.push('/book/' + this.book._id)
            }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .list{
        width: 500px;
        float: left;
    }
    img {
        width: 6rem;
        height: 8rem;
        float: left;
        margin-right: 0.4rem;
    }

    li {
        list-style-type: none;
        margin-left: 1rem;
        margin-right: 1rem;
        border-bottom: 1px solid #e6dbdb;
        padding-bottom: 0.2rem;
        padding-top: 0.2rem;
    }

    li:active,
    li:focus {
        background: #f2f2f2;
    }

    .book-info {
        box-sizing: border-box;
        width: 100%;
        height: 8rem;
        padding-left: 5rem;
        padding-top: 0.2rem;
        padding-bottom: 0.2rem;
    }

    .book-title {
        font-weight: bold;
    }

    .short-intro {
        overflow: hidden;
        -webkit-line-clamp: 2;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;

        color: #655555;
    }

    .book-author {
        color: #655555;
    }

    .book-info p {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 0.7rem;
        line-height: 1.2rem;
    }
</style>
