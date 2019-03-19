<template>
    <div>
        <h2> <Icon type="md-lock"></Icon> 修改密码</h2>
        <hr>
        <Form ref="formCustom" :model="formCustom" :rules="ruleCustom" :label-width="80">
            <FormItem label="邮箱" >
                <Input disabled v-model="user.email"></Input>
            </FormItem>
            <FormItem label="密码" prop="passwd">
                <Input type="password" v-model="formCustom.passwd"></Input>
            </FormItem>
            <FormItem label="确认密码" prop="passwdCheck">
                <Input type="password" v-model="formCustom.passwdCheck"></Input>
            </FormItem>

            <FormItem>
                <Button :loading="loading" style="color: #fff;background-color: #1abc9c;border-color: #1abc9c;"  @click="handleSubmit('formCustom')" >
                    <span v-if="!loading">应用修改</span>
                    <span v-else>Loading...</span>
                </Button>
            </FormItem>
        </Form>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        data() {
            const validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (this.formCustom.passwdCheck !== '') {
                        // 对第二个密码框单独验证
                        this.$refs.formCustom.validateField('passwdCheck');
                    }
                    callback();
                }
            };
            const validatePassCheck = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入确认密码'));
                } else if (value !== this.formCustom.passwd) {
                    callback(new Error('两次密码不一致'));
                } else {
                    callback();
                }
            };

            return {
                formCustom: {
                    passwd: '',
                    passwdCheck: '',
                },
                ruleCustom: {
                    passwd: [
                        { validator: validatePass, trigger: 'blur' },
                        {min:8, message: '不少于8个字符', trigger: 'change'},
                        {max:16, message: '不大于16个字符', trigger: 'change'},
                    ],
                    passwdCheck: [
                        { validator: validatePassCheck, trigger: 'blur' },
                        {min:8, message: '不少于8个字符', trigger: 'change'},
                        {max:16, message: '不大于16个字符', trigger: 'change'},
                    ]
                },
                loading: false,
                email: '',
            }
        },
        computed:{
            ...mapState({
                user: state=>state.AuthUser
            })
        },
        methods: {
            handleSubmit (name) {
                this.loading = true
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        let data = {
                            password: this.formCustom.passwd,
                            password_confirmation: this.formCustom.passwdCheck
                        }
                        this.$http.put('users/' + this.$route.params.name + '/edit_password', data).then((response) => {
                            this.$Message.success('修改成功')
                            this.loading = false
                            this.$refs[name].resetFields();
                        })
                    } else {
                        this.loading = false
                        this.$Message.error('表单信息验证错误!');
                    }
                })
            },
        }
    }
</script>

<style scoped>
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #e4e4e4;
    }
</style>
