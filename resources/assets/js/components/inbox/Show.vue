<template>
    <div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        对话列表
                        <friend-follow-button
                                class="float-right"
                                v-bind:user="messages[0].from_user.id == user.id ? messages[0].to_user.id : messages[0].from_user.id">
                        </friend-follow-button>
                    </div>
                    <div class="card-body">
                        <el-form :model="formData" :rules="rules" ref="formData">
                            <el-form-item prop="body">
                                <el-input
                                        class="col-md-12"
                                        type="textarea"
                                        :rows="4"
                                        v-model="formData.body"
                                ></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button class="btn float-right" type="success" @click="submitMessage">提交</el-button>
                            </el-form-item>
                        </el-form>
                        <div class="messages-list">
                            <div v-for="message in messages" class="media">
                                <img class="rounded-circle" :src="message.from_user.avatar" style="width: 40px" alt="">
                                <div class="media-body">
                                    <h4 class="">
                                        <router-link :to="'/users/'+message.from_user.name">
                                            {{message.from_user.name}}
                                        </router-link>
                                    </h4>
                                    <p>
                                        {{message.body}} <span class="float-right">{{message.created_at | formatDate}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="block">
                            <el-pagination
                                    :current-page.sync="page"
                                    :page-size="10"
                                    layout="prev, pager, next, jumper"
                                    :total="count">
                            </el-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import FriendFollowButton from '../friend/FriendFollowButton'
    import {mapState} from 'vuex'
    export default {
        name: "Show",
        components: {
            FriendFollowButton
        },
        data() {
            return {
                messages: [],
                page: 0,
                count: 0,
                formData: {
                    body: ''
                },
                rules: {
                    'body': [
                        {required: true, message: '消息不能为空', trigger: 'blur'},
                        {min: 6, message: '消息不能小于6个字符', trigger: 'blur'}
                    ],
                },
            }
        },
        computed:mapState ({
            user: state=>state.AuthUser
        }),
        filters: {
            formatDate: function (value) {
                let date = new Date(value);
                let y = date.getFullYear();
                let MM = date.getMonth() + 1;
                MM = MM < 10 ? ('0' + MM) : MM;
                let d = date.getDate();
                d = d < 10 ? ('0' + d) : d;
                let h = date.getHours();
                h = h < 10 ? ('0' + h) : h;
                let m = date.getMinutes();
                m = m < 10 ? ('0' + m) : m;
                let s = date.getSeconds();
                s = s < 10 ? ('0' + s) : s;
                return y + '-' + MM + '-' + d + ' ' + h + ':' + m + ':' + s;
            }
        },
        mounted(){
            axios.get('/api/inbox/' + this.$route.params.id, {
                'page': this.page
            }).then(response=>{
                this.messages = response.data.messages
                this.count = response.data.count
            })
        },
        methods: {
            submitMessage() {
                this.$refs.formData.validate((valid)=> {
                    if (valid) {
                        axios.post('/api/inbox/'+this.$route.params.id+'/store',{
                            'body': this.formData.body
                        }).then(response=>{
                            this.$Message.success('发送私信成功!');
                            this.formData.body = ''
                            // this.messages.push(response.data.data)
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .main-content {
        padding: 25px 0!important;
        /*background: #f5f5f1!important;*/
    }
    .messages-list {
        margin-top: 80px;
    }
    .media {
        margin-top: 15px;
    }
</style>
