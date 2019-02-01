<template>
    <el-button
            size="mini"
            style="height: 44px;width: 28px; margin-top:5px"
            type="primary"
        icon="el-icon-d-caret"
    ></el-button>
</template>

<script>
    export default {
        // props:['answer','count'],
        // data(){
        //     return {
        //         voted:false
        //     }
        // },
        // mounted(){
        //     axios.post('/api/answer/'+this.answer+'/votes/users').then(response=>{
        //         this.voted=response.data.voted
        //     })
        // },
        // computed:{
        //     text(){
        //         return this.count
        //     }
        // },
        // methods:{
        //     vote(){
        //         axios.post('/api/answer/vote',{'answer':this.answer}).then(response=>{
        //             this.voted = response.data.voted
        //             response.data.voted ? this.count ++ : this.count --
        //         })
        //     }
        // }
    }
</script>

<style scoped>

</style>
