<template>
    <div class="form-group">
        <div class="method text-center">
            更多登录方式
        </div>
        <div>
            <ul class="container">
                <li v-for="icon in icons" :key="icon">
                    <a href=""><img :src="icon" alt="" style="width: 25px;height: 25px"></a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                icons:[
                    '/fonts/loginMethod/github.png',
                    '/fonts/loginMethod/qq.png',
                    '/fonts/loginMethod/wx.png',
                ]
            }
        }
    }
</script>

<style scoped>
    .method{
        /*margin-top:10px;*/
        color: #b9bbbe;
        font-size: 15px;
    }
    ul{
        display: block;
        float: left;
        text-align: center;
    }
    li {
        display: inline-block;
        list-style-type: none;
        line-height: 30px;
        margin-right: 10px;
    }
</style>
