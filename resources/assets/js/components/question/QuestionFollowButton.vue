<template>
    <button
            class="btn btn-primary btn-sm"
            v-bind:class="{'btn-success' : followed}"
            v-text="text"
            @click="follow"
    ></button>
</template>

<script>
    export default {
        name: "QuestionFollowButton",
        props: ['question'],
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
                axios.post('/api/question/follow', {'question': this.question}).then(response=>{
                    this.followed = response.data.followed
                    this.count = response.data.count
                })
            }
        }
    }
</script>

<style scoped>

</style>
