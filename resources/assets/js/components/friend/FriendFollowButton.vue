<template>
    <button
            class="btn btn-primary"
            v-bind:class="{'btn-success' : followed}"
            v-text="text"
            @click="follow"
    ></button>
</template>

<script>
    export default {
        name: "FriendFollowButton",
        props: ['user'],
        data() {
            return {
               followed: true,
            }
        },
        computed: {
            text(){
                return this.followed ? '好友' : '添加好友'
            }
        },
        mounted(){
            axios.get('/api/friend/sender/' + this.user).then(response=>{
                this.followed = response.data.followed
            })
        },
        methods: {
            follow() {
                axios.post('/api/friend/send',{user: this.user}).then(response=>{

                })
            }
        }
    }
</script>

<style scoped>

</style>
