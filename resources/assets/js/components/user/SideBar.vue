<template>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <div class="padding-md">
                            <Menu active-name="1" theme="light" class="text-xs-center user-sidebar">
                                <MenuItem name="1">
                                    <router-link :to="'/users/' + user.name + '/edit'" style="color: #495060;">
                                        <div style="width: 100%">
                                            <Icon type="md-card" />
                                            个人信息
                                        </div>
                                    </router-link>
                                </MenuItem>
                                <MenuItem name="2">
                                    <router-link :to="'/users/' + user.name + '/edit_avatar'" style="color: #495060;">
                                        <div style="width: 100%">
                                            <Icon type="md-photos" />
                                            修改头像
                                        </div>
                                    </router-link>
                                </MenuItem>
                                <!--<MenuItem name="3">-->
                                    <!--<router-link :to="'/users/' + user.name + '/edit_email_notify'" style="color: #495060;">-->
                                        <!--<div style="width: 100%">-->
                                            <!--<Icon type="md-notifications"></Icon>-->
                                            <!--消息通知-->
                                        <!--</div>-->
                                    <!--</router-link>-->
                                <!--</MenuItem>-->
                                <MenuItem name="4">
                                    <router-link :to="'/users/' + user.name + '/edit_password'" style="color: #495060;">
                                        <div style="width: 100%">
                                            <Icon type="md-lock" />
                                            修改密码
                                        </div>
                                    </router-link>
                                </MenuItem>
                            </Menu>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="padding-left: 15px;">
                    <div class="panel panel-default padding-md">
                        <div class="panel-body">
                            <transition name="fade" mode="out-in">
                                <router-view></router-view>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: "PersonCenter",
        computed:{
            ...mapState({
                user: state=>state.AuthUser
            })
        },
    }
</script>

<style scoped>
    .jumbotron{
        background-color: #fff;
    }
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
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #e4e4e4;
    }
</style>
