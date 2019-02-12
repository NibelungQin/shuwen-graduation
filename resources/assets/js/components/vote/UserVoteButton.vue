<template>
    <button
        class="btn btn-sm"
        v-bind:class="voted ? 'btn-primary' : 'btn-secondary'"
        @click="vote"
    >
        <i class="el-icon-caret-top"></i>
        <br/>
        {{text}}
    </button>
</template>

<script>
    export default {
        props:['answer','number'],
        data(){
            return {
                voted:false,
                count: this.number
            }
        },
        mounted(){
            axios.post('/api/answer/'+this.answer+'/votes/users').then(response=>{
                this.voted=response.data.voted
            })
        },
        computed:{
            text(){
                return this.count
            }
        },
        methods:{
            vote(){
                axios.post('/api/answer/vote',{'answer':this.answer}).then(response=>{
                    this.voted = response.data.voted
                    response.data.voted ? this.count ++ : this.count --
                })
            }
        }
    }
</script>

<style scoped>

</style>
