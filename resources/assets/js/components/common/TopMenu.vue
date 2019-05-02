<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="/">
                ShuWen
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/'">首页</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/articles'">问章</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/questions'">问心</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/book/category'">问书</router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li v-if="!user.authenticated" class="nav-item">
                        <router-link to="/login" class="nav-link">
                            <button class="white--text btn indigo">登录</button>
                        </router-link>
                    </li>
                    <li v-if="!user.authenticated" class="nav-item">
                        <router-link to="/register" class="nav-link">
                            <button class="white--text btn pink">注册</button>
                        </router-link>
                    </li>

                    <li v-if="user.authenticated" class="uk-navbar-flip uk-hidden-small">
                        <div class="uk-navbar-content">
                            <Dropdown trigger="click" style="margin-left: 20px">
                                <a href="javascript:void(0)">
                                    <Icon type="md-add" style="font-size:25px;color:#8590a6"></Icon>
                                </a>
                                <DropdownMenu slot="list">
                                    <router-link :to="'/questions/create'">
                                        <DropdownItem>提问题</DropdownItem>
                                    </router-link>
                                    <router-link :to="'/articles/create'">
                                        <DropdownItem>写文章</DropdownItem>
                                    </router-link>
                                </DropdownMenu>
                            </Dropdown>
                        </div>
                    </li>
                    <li v-if="user.authenticated" class="uk-navbar-flip uk-hidden-small">
                        <div class="uk-navbar-content">
                            <a @click="jumpNotification">
                                <Badge :count="count" :class="notification_count">
                                    <Icon type="md-notifications" style="font-size:25px;color:#8590a6"></Icon>
                                </Badge>
                            </a>
                        </div>
                    </li><!--<li v-if="user.authenticated"><img :src="user.avatar" id="firstAvatar"  class="rounded-circle" width="40" height="40" alt=""></li>-->
                    <li v-if="user.authenticated" class="uk-navbar-flip uk-hidden-small">
                        <div class="uk-navbar-content">
                            <router-link :to="'/inbox'">
                                <Icon type="md-mail" style="font-size:25px;color:#8590a6"></Icon>
                            </router-link>
                        </div>
                    </li>
                    <li v-if="user.authenticated" class="uk-navbar-flip uk-hidden-small">
                        <div class="uk-navbar-content">
                            <router-link :to="'/reads'">
                                <Icon type="md-time" style="font-size:25px;color:#8590a6"></Icon>
                            </router-link>
                        </div>
                    </li>
                    <li v-if="user.authenticated" class="nav-item dropdown ">
                        <Dropdown>
                            <a href="javascript:void(0)">
                                <img :src="user.avatar" class="avatar rounded-circle" style="width: 40px;height: 40px;background: #fff;padding: 3px;border: 1px solid #c5c5c5;">
                                {{ user.name }}
                                <Icon type="md-arrow-dropdown" />
                                <b class="caret"></b>&nbsp;&nbsp;
                            </a>
                            <DropdownMenu slot="list">
                                <router-link to="/users">
                                    <DropdownItem>
                                        <Icon type="md-person"></Icon>&nbsp;&nbsp;<span>个人中心</span>
                                    </DropdownItem>
                                </router-link>
                                <router-link :to="'/users/' + user.name + '/edit'">
                                    <DropdownItem>
                                        <Icon type="md-settings"></Icon>&nbsp;<span>个人设置</span>
                                    </DropdownItem>
                                </router-link>
                                <DropdownItem>
                                    <div @click.prevent="logout">
                                        <Icon type="md-log-out"></Icon>&nbsp;<span>退出登录</span>
                                    </div>
                                </DropdownItem>
                            </DropdownMenu>
                        </Dropdown>

                        <!--<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">-->
                            <!--<li><router-link :to="{name: 'profile'}">个人中心</router-link></li>-->
                            <!--<li><router-link :to="{name: 'notifications'}">消息</router-link></li>-->
                            <!--<a @click.prevent="logout" class="dropdown-item" href="">-->
                                <!--退出-->
                            <!--</a>-->
                        <!--</ul>-->
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</template>

<script>
    import {mapState} from 'vuex'
    import Echo from 'laravel-echo'
    import JWT from '../../helpers/jwt'
    export default {
        data() {
            return {
                count: 0,
            }
        },
        // created(){
        //     this.$store.dispatch('setAuthUser');
        // },
        computed: {
            notification_count() {
                if (this.$store.state.AuthUser.authenticated) {
                    this.getSocketNotification();
                    axios.get('/api/notifications/count').then((response) => {
                        this.count = response.data.count;
                    })
                }
            },
            ...mapState({
                user: state=>state.AuthUser
            })
        },
        methods: {
            logout(){
                this.$store.dispatch('logoutRequest').then(response=>{
                    this.$router.push({name: 'home'})
                })
            },
            jumpNotification() {
                this.count = 0;
                this.$router.push('/notifications');
            },
            getSocketNotification(){
                window.Echo = new Echo({
                    broadcaster: 'socket.io',
                    host: window.location.hostname + ':6001',
                    auth:
                        {
                            headers:
                                {
                                    'authorization': 'Bearer ' + JWT.getToken()
                                }
                        }
                });
                window.Echo.private('user_room_' + this.$store.state.AuthUser.id)
                    .listen('NotificationPushEvent', (e)=>{
                        this.count = e.count
                    })
            }
        }
    }
</script>

<style scoped>
    .navbar{
        margin-bottom: 0;
        padding: 0.8em;
    }
    .navbar-default .navbar-nav > .active > a{
        color: #555;
        background-color: inherit;
    }
    .dropdown-menu li a{
        padding: 10px 20px;
    }
    .indigo {
        background-color: #3f51b5!important;
        border-color: #3f51b5!important;
    }
    .white--text {
        color: #fff!important;
    }
    .pink {
        background-color: #e91e63!important;
        border-color: #e91e63!important;
    }
    .uk-navbar-brand {
        font-size: 20px;
        color: #525255;
        text-decoration: none;
        box-sizing: border-box;
        display: block;
        height: 100%;
        padding: 0 15px;
        float: left;
        position: relative;
    }
    .uk-navbar-flip {
        float: right;
        height:100%;
        padding: 0.9em 1.5em;
    }
    .uk-navbar-content{
        box-sizing: border-box;
        height: 100%;
        float: left;
        position: relative;
        font-size: 14px;
    }
    .uk-navbar-content:before, .uk-navbar-brand:before, .uk-navbar-toggle:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
    }

</style>
