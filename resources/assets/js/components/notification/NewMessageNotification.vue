<template>
    <li class="notifications" v-bind:class="{'unread' : read}">
        <a :href="read ? '/notifications/'+notification.id+'?redirect_url=/inbox/'+notification.data.dialog_id : '/inbox/'+notification.data.dialog_id">
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
                read: true
            }
        },
        mounted() {
            axios.post('/api/notifications/unread',{
                'notification': this.notification
            }).then(response=>{
                this.read = response.data.read
            })
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
