<template>
    <div>
        <h2><Icon type="md-notifications"></Icon> 我的提醒</h2>
        <hr>
        <Timeline>
            <TimelineItem v-for="notification in notifications" :key="notification.id">
                <div class="content" v-if="notification.type == 'new-user-follow-notification'">
                    <new-user-follow-notification
                            :name="notification.data.name"
                            :avatar="notification.data.avatar"
                            :read_at="notification.read_at"
                            :created_diff="notification.created_diff"
                    ></new-user-follow-notification>
                </div>
                <div class="content" v-if="notification.type == 'new-message-notification'">
                    <new-message-notification
                            :id="notification.id"
                            :userId="notification.data.userId"
                            :dialog_id="notification.data.dialog_id"
                            :name="notification.data.name"
                            :avatar="notification.data.avatar"
                            :read_at="notification.read_at"
                            :created_diff="notification.created_diff"
                    ></new-message-notification>
                </div>
                <div class="content" v-if="notification.type == 'received-comment-notification'">
                    <received-comment-notification
                            :avatar="notification.data.reply_user.avatar"
                            :name="notification.data.reply_user.name"
                            :created_diff="notification.created_diff"
                            :body="notification.data.body"
                            :title="notification.data.commentable.title"
                            :read_at="notification.read_at"
                            :slug="notification.data.commentable.id"
                    ></received-comment-notification>
                </div>
            </TimelineItem>
        </Timeline>
    </div>
</template>

<script>
    import NewMessageNotification from './NewMessageNotification'
    import NewUserFollowNotification from './NewUserFollowNotification'
    import ReceivedCommentNotification from './ReceivedCommentNotification'
    import SendFriendNotification from './SendFriendNotification'
    export default {
        name: "Notification",
        components: {
            NewMessageNotification,
            NewUserFollowNotification,
            ReceivedCommentNotification,
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
    .content{
        padding-left: 5px;
        margin-top: -8px;
    }
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #e4e4e4;
    }
</style>
