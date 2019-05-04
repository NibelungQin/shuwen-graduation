<template>
    <button
            class="btn btn-success btn-lg"
            v-bind:class="{'active' : followed}"
            v-text="text"
            @click="follow"
    ></button>
</template>

<script>
    export default {
        name: "ArticleFollowButton",
        props: ['article','can'],
        data() {
            return {
                followed: true,
                count: 0,
            }
        },
        mounted(){
            axios.post('/api/article/follower', {'article': this.article}).then(response=>{
                this.followed = response.data.followed;
                this.count = response.data.count
            })
        },
        computed:{
            text() {
                return this.followed ? '已关注' + ' | ' + this.count : '关注' + ' | ' + this.count
            }
        },
        methods: {
            follow(){
                if (this.can){
                    axios.post('/api/article/follow', {'article': this.article}).then(response=>{
                        this.followed = response.data.followed
                        this.count = response.data.count
                    })
                } else {
                    this.$Message.warning('你需要登录才可以关注！');
                }
            }
        }
    }
</script>

<style scoped>

</style>
