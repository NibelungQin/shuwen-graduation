<template>
    <button
            class="btn btn-success btn-sm"
            v-bind:class="{'active' : followed}"
            v-text="text"
            @click="follow"
    ></button>
</template>

<script>
    export default {
        name: "QuestionFollowButton",
        props: ['question','can'],
        data() {
            return {
                followed: true,
                count: 0,
            }
        },
        mounted(){
            axios.post('/api/question/follower', {'question': this.question}).then(response=>{
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
                if (this.can) {
                    axios.post('/api/question/follow', {'question': this.question}).then(response=>{
                        this.followed = response.data.followed
                        this.count = response.data.count
                    })
                }else {
                    this.$Message.warning('你需要登录才可以关注！');
                }
            }
        }
    }
</script>

<style scoped>

</style>
