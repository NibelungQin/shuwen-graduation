<template>
    <div class="theme-light">
        <top-menu></top-menu>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    import TopMenu from './common/TopMenu'
    import jwtToken from '../helpers/jwt'
    import Cookie from 'js-cookie'
    export default {
        components:{
            TopMenu
        },
        created(){
            if (jwtToken.getToken()){
                this.$store.dispatch('setAuthUser')
            }else if (Cookie.get('auth_id')){
                this.$store.dispatch('refreshToken')
            }
        }
    }
</script>

<style scoped>
    .theme-light{
        background: #f5f5f1!important;
    }
</style>
