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
                        <a class="nav-link" href="/">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">问章</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/questions">问心</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/book/category">问书</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/questions/create">发起问题</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li v-if="!user.authenticated" class="nav-item">
                        <router-link to="/login" class="nav-link">登录</router-link>
                    </li>
                    <li v-if="!user.authenticated" class="nav-item">
                        <router-link to="/register" class="nav-link">注册</router-link>
                    </li>

                    <li v-if="user.authenticated" class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{user.name}} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><router-link :to="{name: 'profile'}">个人中心</router-link></li>
                            <li><router-link :to="{name: 'notifications'}">消息</router-link></li>
                            <a @click.prevent="logout" class="dropdown-item" href="">
                                退出
                            </a>
                        </ul>
                    </li>
                    <li v-if="user.authenticated"><img :src="user.avatar" id="firstAvatar" class="rounded-circle" width="50" height="50" alt=""></li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        created(){
            this.$store.dispatch('setAuthUser');
        },
        computed:mapState({
            user: state=>state.AuthUser
        }),
        methods: {
            logout(){
                this.$store.dispatch('logoutRequest').then(response=>{
                    this.$router.push({name: 'home'})
                })
            }
        }
    }
</script>

<style scoped>
    .navbar{
        margin-bottom: 0;
        padding: 2em;
    }
    .navbar-default .navbar-nav > .active > a{
        color: #555;
        background-color: inherit;
    }
    .dropdown-menu li a{
        padding: 10px 20px;
    }
</style>
