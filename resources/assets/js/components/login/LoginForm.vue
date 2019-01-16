<template>
    <el-form :model="dataForm" :rules="rules" ref="dataForm">
        <el-form-item prop="email">
            <el-input
                    type="text"
                    v-model="dataForm.email"
                    auto-complete="off"
                    placeholder="请输入账号"
            ></el-input>
        </el-form-item>
        <el-form-item prop="password">
            <el-input
                    type="password"
                    v-model="dataForm.password"
                    auto-complete="off"
                    placeholder="请输入密码"
            ></el-input>
        </el-form-item>
        <el-checkbox
                v-model="checked"
                checked class="remember"
        >记住密码</el-checkbox>
        <a class="float-right" href="">忘记密码？</a>
        <el-form-item>
            <el-button
                    type="primary"
                    class="btn-block"
                    @click.native.prevent="loginSubmit"
                    :loading="logining"
            >登录</el-button>
        </el-form-item>
    </el-form>

</template>

<script>
    export default {
        data(){
            return {
                logining: false,
                dataForm: {
                    email: '2456134825@qq.com',
                    password: '123456789'
                },
                rules: {
                    email: [
                        { required: true, message: '请输入账号', trigger: 'blur' },
                        { min: 6, message: '账号长度不小于6个字符', trigger: 'blur'},
                        { type: "email", message: '邮箱格式错误', trigger: 'blur'}
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' },
                        { min: 6, message: '密码长度不小于6个字符', trigger: 'blur'},
                    ]
                },
                checked: true,
                user:{}
            }
        },
        methods: {
            loginSubmit() {
                this.logining = true;
                let data = {
                    email: this.dataForm.email,
                    password: this.dataForm.password
                };
                this.$refs.dataForm.validate((valid)=>{
                    if (valid){
                        this.$store.dispatch('loginRequest',data).then(response=>{
                            this.$router.push({name: 'home'})
                        }).catch(error=>{
                            if(error.response.status === 421){
                                this.$message({
                                    showClose: true,
                                    message: '账号或密码错误',
                                    type: 'error',
                                    center: true
                                });
                                this.logining = false
                            }
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
