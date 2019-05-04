<template>
    <div class="base_content">
        <div class="profile-app__KJyN">
            <div class="header__NyBc">
                <div class="bg-wrapper__teZt">
                    <div class="background__26YF"></div>
                </div>
                <div class="container container__28Ei">
                    <div class="" style="display: flex;width:100%">
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
                                </div>
                                <div v-if="auth.id == user.id" class="action">
                                        <span>
                                              <router-link class="btn btn-primary" :to="'/users/' + user.name + '/edit'">编辑资料</router-link>
                                        </span>
                                </div>
                                <div v-else class="action">
                                    <user-follow-button :user="user.id" class="float-left" style="margin-right:10px"></user-follow-button>
                                    <send-message :user="user.id"></send-message>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="experience">
                                        <h4 class="experience-count">
                                            <p>{{user.followings_count}}</p>
                                            <span slot="intro">关注</span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="experience">
                                        <h4 class="experience-count">
                                            <p>{{user.comments_count}}</p>
                                            <span slot="intro">评论数</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container nav-toggled__oxhf nav__2IK2">
                <div class="side__1bvU">
                    <div class="sidebar-base__2RIZ">
                        <div class="header__2nTK">
                            <span class="banner-profile__twitter">
                                <a title="注册用户">
                                    <Icon type="logo-vimeo" />
                                </a>
                            </span>
                        </div>
                        <div>
                            <Menu active-name="1" theme="light">
                                <MenuItem name="1">
                                    <router-link :to="'/users/' + user.name">
                                        <div style="width: 100%;color: #495060;">
                                            <Icon type="md-chatbubbles" />
                                            Ta发表的回复
                                        </div>
                                    </router-link>
                                </MenuItem>
                                <MenuItem name="2">
                                    <router-link :to="'/users/' + user.name + '/following'">
                                        <div style="width: 100%;color: #495060;">
                                            <Icon type="md-happy" />
                                            Ta关注的用户
                                        </div>
                                    </router-link>
                                </MenuItem>
                            </Menu>
                        </div>
                    </div>
                </div>
                <div class="content-toggled__1rll content__2Ok3">
                    <div class="container__PZyq">
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import JWT from '../../helpers/jwt'
    import SendMessage from '../message/SendMessage'
    import UserFollowButton from '../question/UserFollowButton'
    export default {
        components: {
            SendMessage,
            UserFollowButton
        },
        data() {
            return {
                user:{
                    followings_count: 0,
                    comments_count: 0,
                    is_following: false
                },
                comments_name: 'comments_name',
                followings_name: 'followings_name',
            }
        },
        computed: {
            ...mapState({
                auth: state=>state.AuthUser
            })
        },
        watch: {
            '$route' (to, from) {
                this.loadData()
            }
        },
        created() {
            this.loadData()
        },
        methods: {
            // following(id) {
            //     this.$http.post('users/' + id + '/follow').then((response) => {
            //         return this.user.is_following = ! this.user.is_following
            //     })
            // },
            loadData() {
                axios.get('/api/users/' + this.$route.params.name).then((response) => {
                    this.user = response.data
                    document.title = this.user.name + ' 个人信息 | NibelungQin'
                })
            }
        },
    }
</script>

<style scoped>
    .base_content{
        margin-top: 20px;
        z-index:998;
        color: #fff;
    }
    .header__NyBc {
        height: 275px;
        margin-top: -30px;
    }
    .header__NyBc .bg-wrapper__teZt {
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        height: 387px;
        width: 100%;
        overflow: hidden;
    }
    .header__NyBc .background__26YF {
        position: absolute;
        width: 100%;
        height: 100%;
        background: -webkit-linear-gradient(240deg,#222 15%,#373737 70%,#3c4859 94%);
        background: -o-linear-gradient(240deg,#222 15%,#373737 70%,#3c4859 94%);
        background: linear-gradient(-150deg,#222 15%,#373737 70%,#3c4859 94%);
    }
    .header__NyBc .container__28Ei {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding-top: 65px;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .avatar-base__19M6 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        text-align: center;
        position: relative;
    }
    .avatar__2sMj {
        cursor: pointer;
        height: 140px;
        width: 140px;
        border: 5px solid #fff;
        border-radius: 15px;
    }
    .user-info__2aLr {
        overflow: hidden;
        margin-left: 20px;
        margin-right: 20px;
    }
    .user-info__2aLr .name__3EWH {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .user-info__2aLr .container__1Mii {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        max-width: 90%;
    }

    .user-info__2aLr .name-text__1-NA {
        color: #fff;
        font-size: 24px;
        white-space: nowrap;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
    }
    .user-info__2aLr .name__3EWH .right-side__3zuc {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        -ms-flex: 1 0 0px;
        flex: 1 0 0;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }
    .user-info__2aLr .public__2p3C {
        margin-left: 8px;
        font-size: 16px;
    }
    .user-info__2aLr .header{
        font-size: 18px;
        font-weight: bold;
    }
    .user-info__2aLr .description{
        font-size: 16px;
        margin: 10px 0;
    }

    .nav__2IK2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -ms-flex-direction: row;
        flex-direction: row;
        position: relative;
    }
    .side__1bvU {
        width: 25%;
        min-height: 600px;
    }
    .sidebar-base__2RIZ .header__2nTK {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        margin-left: 20px;
        position: relative;
        top: 30px;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        text-align: center;
    }
    .sidebar-base__2RIZ ul {
        margin-top: 90px;
        -webkit-padding-start: 0;
        width:100% !important;
        background-color: transparent;
    }
    .sidebar-base__2RIZ ul li {
        list-style: none;
        padding-right: 20px;
        margin: 10px;
    }
    .ivu-menu-light.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu) {
        color: #fff!important;
        background-color: #64b9f9;
        z-index: 2;
    }
    .ivu-menu-vertical .ivu-menu-item:hover, .ivu-menu-vertical .ivu-menu-submenu-title:hover{
        background-color: #64b9f9;
        color: #fff!important;
    }

    .active__1IwF {
        background-color: #64b9f9;
        color: #fff!important;
    }
    .content-toggled__1rll {
        right: 0;
    }

    .content__2Ok3 {
        width: 75%;
        -webkit-transition: right .3s cubic-bezier(.17, .04, .03, .94);
        -o-transition: right .3s cubic-bezier(.17, .04, .03, .94);
    }
    .container__PZyq:hover {
        -webkit-box-shadow: 0 15px 30px 0 rgba(0,0,0,.15);
        box-shadow: 0 15px 30px 0 rgba(0,0,0,.15);
    }

    .container__PZyq {
        min-height: 600px;
        background: #fff;
        border-radius: 5px;
        margin-bottom: 50px;
        font-size: 14px;
        -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.08);
        box-shadow: 0 5px 15px 0 rgba(0,0,0,.08);
        -webkit-transition: -webkit-box-shadow .4s;
        transition: -webkit-box-shadow .4s;
        -o-transition: box-shadow .4s;
        transition: box-shadow .4s;
        transition: box-shadow .4s,-webkit-box-shadow .4s;
        color:#000;
    }
    .section__3bS4 {
        padding: 10px 15px;
        border: none;
        margin-bottom: 0px;
        border-bottom: 1px solid #f2f2f2;
    }
    .section__3bS4 a {
        color: #15b982;
    }
    .experience {
        right: 0;
        text-align: right;
    }
    .sn-inline {
        list-style: none;
        display: inline;
        margin: 0;
        padding: 0;
        vertical-align: text-bottom;
    }
    .banner-profile__github {
        margin: 0 9px 0 0;
        align-items: center;
    }
    .banner-profile__github i{
        background: #222;
        color: #fff;
        padding: 7px 7px 6px;
        border-radius: 3px;
        margin-right: 7px;
    }

    .banner-profile__twitter {
        margin: 0 9px 0 0;
        align-items: center;
    }
    .banner-profile__twitter i{
        background: #ff5252;
        color: #fff;
        padding: 7px 7px 6px;
        border-radius: 3px;
        margin-right: 7px;
    }

    .experience-count {
        margin: 0;
        font-size: 60px;
        color: #15B982;
    }
    .experience-count span {
        display: block;
        color: #fff;
        font-size: .5em;
        position: relative;
    }
</style>
