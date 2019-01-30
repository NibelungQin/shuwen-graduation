<template>
    <div>
        <div class="media">
            <div
                    v-for="answer in answers"
            >
                <p v-html="answer.body"></p>
            </div>
        </div>
        <a href="" @click="more">点击查看更多</a>
    </div>
</template>

<script>
    export default {
        name: "Show",
       data() {
            return {
                pagination: {
                    total: 0,
                    currentPage: 1,
                },
                answers: [],
            }
       },
        mounted() {
            axios.get('http://shuwen.nibelung.top/api/questions/' + this.$route.params.id + '/answer').then(response=>{
                // this.answers=response.data.data
                this.$set(this, 'answers', response.data.data.data)
                this.$set(this, 'pagination', response.data.pagination)
            })
        },
        methods: {
            more(){

            }
        }
    }
</script>

<style scoped>

</style>
