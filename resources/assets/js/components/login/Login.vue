<template>
    <div class="login" v-bind:style="{backgroundImage:'url(' + backImg + ')'}">
        <div class="login-page">
            <div class="card">
                <div class="card-header">登录</div>
                <div class="text-center card-title">
                    <h2>书问</h2>
                </div>
                <div class="card-body">
                    <login-form></login-form>
                </div>
                <div class="card-footer">
                    <login-method></login-method>
                    <div class="text-center">
                        没有账号？
                        <router-link :to="{name:'register'}">
                            <span>注册</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginForm from './LoginForm';
    import LoginMethod from  '../common/LoginMethod';
    export default {
        components:{
            LoginForm,
            LoginMethod
        },
        data(){
            return{
                backImg:'/fonts/background/background.png'
                // backImg:''
            }
        }
    }
</script>

<style scoped>
    .login{
        position:fixed;
        top:0;
        bottom:0;
        right:0;
        left:0;
        z-index:-1;
        background-size: cover;
        background-attachment:fixed;
        display:flex;
        /* 垂直居中         */
        flex-direction:column;
        /* 水平居中 */
        justify-content:center;
        align-items:center;
    }
    .login-page{
        width: 400px;
        height: 450px;
    }
</style>
