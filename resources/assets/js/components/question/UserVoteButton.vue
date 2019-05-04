<template>
    <button
            class="btn btn-primary btn-sm"
            v-bind:class="{'active' : voted}"
            v-text="text"
            @click="vote"
    ></button>
</template>

<script>
    export default {
        name: "UserVoteButton",
        props:['question','number','can'],
        data(){
            return {
                voted:false,
                count: this.number
            }
        },
        mounted(){
            axios.post('/api/question/'+this.question+'/votes/users').then(response=>{
                this.voted=response.data.voted
            })
        },
        computed:{
            text(){
                return this.voted ? '已赞' + ' | ' + this.count : '点赞' + ' | ' + this.count
            }
        },
        methods:{
            vote(){
                if (this.can){
                    axios.post('/api/question/vote',{'question':this.question}).then(response=>{
                        this.voted = response.data.voted
                        response.data.voted ? this.count ++ : this.count --
                    })
                } else {
                    this.$Message.warning('你需要登录才可以点赞！');
                }
            }
        }
    }
</script>

<style scoped>

</style>
