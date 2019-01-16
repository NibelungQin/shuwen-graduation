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
                        <a class="nav-link" href="/book/category">图书</a>
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
                        <img class="img-fluid" src="" alt="">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{user.name}} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a @click.prevent="logout" class="dropdown-item" href="">
                                退出
                            </a>

                        </div>
                    </li>
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

</style>
