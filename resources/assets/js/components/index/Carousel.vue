<template>
    <div>
        <el-carousel :interval="4000" type="card" height="250px">
            <el-carousel-item v-for="article in articles" :key="article.id">
                <router-link :to="'/articles/' + article.id">
                    <div style="position:relative;">
                        <img :src="article.image" alt="" style="width:100%">
                        <span class="headline" style="position:absolute; z-index:2; left:10px; top:10px">{{article.title}}</span>
                    </div>
                </router-link>
            </el-carousel-item>
        </el-carousel>
    </div>
</template>

<script>
    export default {
        name: "Carousel",
        data() {
            return {
                articles: [],
            }
        },
        created() {
            axios.get('/api/home/carousel').then(response => {
                this.articles = response.data
            })
        }
    }
</script>

<style scoped>
    .el-carousel__item h3 {
        color: #475669;
        font-size: 14px;
        opacity: 0.75;
        line-height: 200px;
        margin: 0;
    }
    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }
    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }
    .headline {
        color: white;
        font-size: 18px!important;
        font-weight: 400;
        line-height: 32px!important;
        letter-spacing: normal!important;
    }
</style>