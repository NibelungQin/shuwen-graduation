<template>
    <li class="notifications " v-bind:class="{'unread' : read}">
        <a :href="notification.data.name">
            {{notification.data.name}}
        </a>关注了你
    </li>
</template>

<script>
    export default {
        name: "NewUserFollowNotification",
        props: ['notification'],
        data() {
            return {
                read: true
            }
        },
        mounted() {
            axios.post('/api/notifications/unread',{
                'notifiaction': this.notifiaction
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
