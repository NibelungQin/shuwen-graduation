<template>
    <div class="container">
        <div class="main">
            <div class="main-inner">
                <div class="sd">
                    <div class="m-hd">
                        <div class="header">
                            <div class="avatar">
                                <img src="/images/avatars/matt-1.jpg" alt="">
                            </div>
                            <div class="info">
                                <div class="name">NibelungQin</div>
                                <div class="menu">
                                    <i class="iconfont icon-menu"></i>
                                </div>
                            </div>
                        </div>
                        <div class="search">
                            <i class="iconfont icon-sousuo u-search"></i>
                            <input type="text" placeholder="搜索">
                        </div>
                        <ul class="m-tab">
                            <li class="current">
                                <i class="iconfont icon-liaotian"></i>
                            </li>
                            <li class="">
                                <i class="iconfont icon-yuedu"></i>
                            </li>
                            <li class="">
                                <i class="iconfont icon-tongxunlu"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="m-lst-box topnav_box">
                        <div class="m-lst">
                            <chat-item></chat-item>
                        </div>
                    </div>
                </div>
                <div class="chat-box">
                    <chat-area></chat-area>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ChatItem from './ChatItem'
    import ChatArea from './ChatArea'
    export default {
        name: "Chat",
        components: {
            ChatItem,
            ChatArea,
        }
    }
</script>

<style scoped>
    .topnav_box::-webkit-scrollbar
    {
        width: 5px;
        height:10px;
        background-color:#aaa;
    }
    .topnav_box::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color:#eee;
    }
    .topnav_box::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color:#aaa;
    }

    .name {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        word-wrap: normal;
        font-weight: 400;
        font-size: 13px;
        color: #fff;
        line-height: 20px;
    }
    .main {
        padding-bottom: 50px;
        height: 720px;
        transition: padding .3s linear;
        -webkit-transition: padding .3s linear;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .main-inner {
        width: 1000px;
        height: 100%;
        margin: 0 auto;
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        overflow: hidden;
        display: flex;
    }
    .sd {
        width: 28%;
        height: 100%;
        background: #2e3238;
        position: relative;
    }
    .m-hd {
        border-bottom: 1px solid #24272c;
    }
    .header {
        padding: 18px;
        box-sizing: border-box;
    }
    .avatar {
        float: left;
    }
    img {
        width: 40px;
        height: 40px;
        border-radius: 3px;
    }
    .info {
        margin-left: 50px;
        height: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .name {
        font-size: 18px;
    }
    .menu {
        cursor: pointer;
        color: #fff;
    }
    .search {
        padding-top: 0;
        position: relative;
    }
    .u-search {
        position: absolute;
        color: #ddd;
        font-size: 20px;
        line-height: 34px;
        left: 22px;
    }
    input {
        width: 90%;
        margin-left: 5%;
        height: 32px;
        line-height: 32px;
        border: 0;
        border-radius: 2px;
        background-color: #26292e;
        color: #fff;
        padding-left: 30px;
        font-size: 12px;
        box-sizing: border-box;
    }
    .m-tab {
        margin-left: -20px;
        padding-top: 10px;
        color: #fff;
        padding-bottom: 5px;
        display: flex;
    }
    .current {
        color: #3caf36;
    }
    li {
        list-style-type:none;
        width: 33%;
        text-align: center;
        cursor: pointer;
        position: relative;}
    i {
        font-size: 25px;
        line-height: 30px;
    }
    li:after {
        content: '';
        position: absolute;
        top: 5px;
        right: 0;
        width: 0;
        height: 20px;
        border-right: 1px solid #24272c;
    }
    li:last-child:after {
        visibility: hidden;
    }

    .m-lst-box {
        position: absolute;
        top: 156px;
        right: 0;
        bottom: 0;
        left: 0;
        overflow-y: auto;
    }

    .chat-box {
        height: 100%;
        width: 72%;
        background-color: #eee;
        overflow: hidden;
        position: relative;
    }
    .panel {
        background-color: #fff;
        margin-top: 200px;
        display: inline-block;
        padding: 20px;
        border-radius: 10px;
        margin-left: 45%;
        width: 200px;
        line-height: 30px;
        text-align: center;
    }
    /*input {*/
        /*text-align: center;*/
        /*height: 30px;*/
    /*}*/
    .ok {
        margin-top: 10px;}
    span {
        padding: 5px 20px;
        cursor: pointer;
        background-color: #4ab34a;
        border-radius: 4px;
        color: #fff;
    }
</style>
