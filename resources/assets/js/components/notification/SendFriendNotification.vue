<template>
    <li class="notifications" v-bind:class="{'unread' : read}">
        <a @click="about">
            {{notification.data.name}}请求添加你成为好友！
        </a>
    </li>
</template>

<script>
    export default {
        name: "SendFriendNotification",
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
            about() {
                this.$confirm('是否添加该好友?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post('/api/friend/accept',{'user': this.notification.data.id})
                    this.$message({
                        type: 'success',
                        message: '添加该好友成功!'
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消添加'
                    });
                });
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
