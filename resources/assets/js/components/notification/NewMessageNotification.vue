<template>
    <li class="notifications" v-bind:class="{'unread' : read}">
        <a @click="about">
            {{notification.data.name}}给你发送了一条私信
        </a>
    </li>
</template>

<script>
    export default {
        name: "NewMessageNotification",
        props: ['notification'],
        data() {
            return {
                read: true,
            }
        },
        mounted() {
            axios.post('/api/notifications/unread',{
                'notification': this.notification
            }).then(response=>{
                this.read = response.data.read
            })
        },
        methods: {
            about(){
                if (this.read){
                    axios.get('/api/notifications/' + this.notification.id)
                        .then(response=>{
                            this.$router.push({name: 'inboxShow', params: {id: this.notification.data.dialog_id}})
                        })
                } else {
                    this.$router.push({name: 'inboxShow', params: {id: this.notification.data.dialog_id}})
                }
            }
        }
    }
</script>

<style scoped>
    .notifications {
        position: relative;
        padding: 8px 15px 8px 25px;
        color: #666;
        border: none;
        border-top: 1px dotted #eee;
        background: transparent;
    }
    .notifications.unread {
        background: #fff9ea;
    }
</style>
