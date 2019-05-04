<template>
    <div class="login" v-bind:style="{backgroundImage:'url(' + backImg + ')'}">
        <div class="login-page">
            <div class="card">
                <div class="card-header">注册</div>
                <div class="text-center title">
                    <h2>书问</h2>
                </div>
                <div class="card-body">
                    <register-form></register-form>
                </div>
                <div class="card-footer">
                    <login-method></login-method>
                    <div class="text-center">
                        已有账号？
                        <router-link :to="{name:'login'}">
                            <span>登录</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RegisterForm from './RegisterForm';
    import LoginMethod from  '../common/LoginMethod';
    export default {
        components:{
            RegisterForm,
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
        z-index:11;
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
    .title{
        margin-top: 10px;
    }
</style>
