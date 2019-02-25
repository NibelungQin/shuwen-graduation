<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">消息通知</div>
                    <div class="card-body">
                        <div v-for="notification in notifications">
                            <component
                                    v-bind:is="notification.type"
                                    :notification="notification"
                            ></component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NewMessageNotification from './NewMessageNotification'
    import NewUserFollowNotification from './NewUserFollowNotification'
    export default {
        name: "Index",
        components: {
            NewMessageNotification,
            NewUserFollowNotification
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

</style>
