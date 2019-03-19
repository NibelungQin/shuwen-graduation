<template>
    <div>
        <h2><Icon type="md-notifications"></Icon> 我的提醒</h2>
        <hr>
        <div v-for="notification in notifications">
            <div v-if="notification.type == 'new-user-follow-notification'">
                <new-user-follow-notification
                        :name="notification.data.name"
                        :avatar="notification.data.avatar"
                        :read_at="notification.read_at"
                        :created_diff="notification.created_diff"
                ></new-user-follow-notification>
            </div>
            <div v-if="notification.type == 'new-message-notification'">
                <new-message-notification
                        :name="notification.data.name"
                        :avatar="notification.data.avatar"
                        :read_at="notification.read_at"
                        :created_diff="notification.created_diff"
                ></new-message-notification>
            </div>
        </div>
    </div>
</template>

<script>
    import NewMessageNotification from './NewMessageNotification'
    import NewUserFollowNotification from './NewUserFollowNotification'
    import SendFriendNotification from './SendFriendNotification'
    export default {
        name: "Notification",
        components: {
            NewMessageNotification,
            NewUserFollowNotification,
            SendFriendNotification,
        },
        data() {
            return {
                notifications: [],
            }
        },
        mounted(){
            axios.get('/api/notifications').then(response=>{
                this.notifications = response.data.notifications
            })
        }
    }
</script>

<style scoped>
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #e4e4e4;
    }
</style>
