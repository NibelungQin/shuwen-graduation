<template>
    <div class="jumbotron">
        <div class="base_content">
            <div class="profile-app__KJyN">
                <div class="header__NyBc">
                    <div class="bg-wrapper__teZt">
                        <div class="background__26YF"></div>
                    </div>
                    <div class="container container__28Ei">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="avatar-base__19M6">
                                    <a>
                                        <img :src="user.avatar" alt="Avatar" class="avatar__2sMj">
                                    </a>
                                </div>
                                <div style="color: #aaa;margin: 5px 0 0 0;text-align:center;">
                                    最后活跃于
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="user-info__2aLr">
                                    <div class="header">
                                        {{ user.name }}
                                    </div>
                                    <div class="description">
                                        {{ user.avatar }}
                                    </div>
                                    <div class="action" v-if="user.authenticated">
                                    <span>
                                          <button color="warning" style="margin-left: -2px;" small :to="'/users/' + user.name + '/edit'">编辑资料</button>
                                    </span>
                                        <span>
                                       <!--<v-btn :color="user.is_following ? 'teal' : 'error'" style="margin-left: -2px;" small v-if="is_me" @click="following(user.id)">{{ user.is_following ? '关注中' : '关注' }}</v-btn>-->
                                  </span>

                                    </div>
                                    <div class="action" v-else>
                                        <v-btn color="error" style="margin-left: -2px;" small to="/login">关注</v-btn>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        data() {
            return {
                // user:{
                //     followings_count: 0,
                //     comments_count: 0,
                //     is_following: false
                // },
                comments_name: 'comments_name',
                followings_name: 'followings_name',
            }
        },
        computed: {
            ...mapState({
                user: state=>state.AuthUser
            })
        },
        // watch: {
        //     '$route' (to, from) {
        //         this.loadData()
        //     }
        // },
        // created() {
        //     this.loadData()
        // },
        // methods: {
        //     following(id) {
        //         this.$http.post('users/' + id + '/follow').then((response) => {
        //             return this.user.is_following = ! this.user.is_following
        //         })
        //     },
        //     loadData() {
        //         this.$http.get('users/' + this.$route.params.name).then((response) => {
        //             this.user = response.data
        //             document.title = this.user.name + ' 个人信息 | cocoyo'
        //         })
        //     }
        // },
    }
</script>

<style scoped>
    @import "../../styles/index.less";
</style>
