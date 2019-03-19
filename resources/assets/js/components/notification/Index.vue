<template>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <div class="padding-md">
                            <Menu active-name="1" theme="light" class="text-xs-center user-sidebar">
                                <router-link to="/" style="color: #495060;">
                                    <MenuItem name="1">
                                        <Icon type="md-notifications"></Icon>
                                        通知消息
                                    </MenuItem>
                                </router-link>
                            </Menu>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default padding-md">
                        <div class="panel-body" style="font-size: 14px;color: #000;">
                            <notification></notification>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Notification from './Notification'
    import NewMessageNotification from './NewMessageNotification'
    import NewUserFollowNotification from './NewUserFollowNotification'
    import SendFriendNotification from './SendFriendNotification'
    export default {
        name: "Index",
        components: {
            Notification,
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
    .ivu-menu-light.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu) {
        color: #fff!important;
        background-color: rgb(26, 188, 156) !important;
        z-index: 2;
        border-right: none !important;
    }
    .ivu-menu-vertical.ivu-menu-light:after{
        display: none !important;
    }
    .ivu-menu.user-sidebar{
        width: 100% !important;
    }
    .ivu-menu-vertical .ivu-menu-item:hover, .ivu-menu-vertical .ivu-menu-submenu-title:hover {
        background: rgb(26, 188, 156) !important;
        color: #fff !important;
    }
    .box {
        background-color: #fff;
        padding: 10px;
        margin: 0 0 20px 0;
        -webkit-box-shadow: 0 0.2em 0 0 #ddd, 0 0 0 1px #ddd;
        box-shadow: 0 0.2em 0 0 #ddd, 0 0 0 1px #ddd;
    }
    .padding-md {
        padding: 15px;
    }
    .panel{
        border-radius: 0px;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid #dde2e8;
        margin-bottom: 20px;
        background-color: #fff;
    }
    .panel .panel-heading, .panel .panel-body {
        border: none;
        padding: 15px;
    }
    .panel-body h2{
        color: #495060 !important;
    }

</style>
