<template>
    <el-form :model="dataForm" :rules="rules" ref="dataForm">
        <el-form-item prop="name">
            <el-input
                    type="text"
                    v-model="dataForm.name"
                    auto-complete="off"
                    placeholder="请输入用户名"
            ></el-input>
        </el-form-item>
        <el-form-item prop="email">
            <el-input
                    type="text"
                    v-model="dataForm.email"
                    auto-complete="off"
                    placeholder="请输入邮箱"
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
        <el-form-item prop="checkPass">
            <el-input
                    type="password"
                    v-model="dataForm.checkPass"
                    auto-complete="off"
                    placeholder="请确认密码"
            ></el-input>
        </el-form-item>
        <el-form-item>
            <el-button
                    type="primary"
                    class="btn-block"
                    @click.native.prevent="registerSubmit"
                    :loading="logining"
            >注册</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        data(){
            let validatePass = (rule, value, callback) => {
                if (value !== this.dataForm.password) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return {
                logining: false,
                dataForm: {
                    name: '',
                    email: '',
                    password: '',
                    checkPass: '',
                },
                rules: {
                    name: [
                        { required: true, message: '请输入用户名', trigger: 'blur' },
                        { min: 6, message: '用户名长度不小于6个字符', trigger: 'blur'},
                    ],
                    email: [
                        { required: true, message: '请输入账号', trigger: 'blur' },
                        { min: 6, message: '账号长度不小于6个字符', trigger: 'blur'},
                        { type: "email", message: '邮箱格式错误', trigger: 'blur'}
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' },
                        { min: 6, message: '密码长度不小于6个字符', trigger: 'blur'},
                    ],
                    checkPass: [
                        { required: true, message: '请再次输入密码', trigger: 'blur' },
                        { validator: validatePass, trigger: 'change' }
                    ]
                },
                checked: true,
                user:{}
            }
        },
        methods:{
            registerSubmit(){
                let data = {
                    name: this.dataForm.name,
                    email: this.dataForm.email,
                    password: this.dataForm.password,
                };
                axios.post('/api/register', data).then(function () {
                    this.$router.push({name: 'bookCategory'})
                }).catch(function (response) {

                })
            }
        }
    }
</script>

<style scoped>

</style>
