<template>
    <div class="chat-area">
        <div class="box-hd">
            <div class="title">群聊</div>
        </div>
        <div class="chat-bd topnav_box">
            <div class="empty">暂时没有新消息</div>
            <div class="msg-item clearfix msg-item-left">
                <div class="nt-item">
                    <img class="image" src="/images/avatars/matt-1.jpg" alt="">
                    <div>
                        <div class="show-name">Nibelung</div>
                        <div class="content">
                            Hello world!
                        </div>
                    </div>
                </div>
            </div>
            <div class="msg-item msg-item-right clearfix">
                <div class="nt-item">
                    <div class="content">
                        Hello world!
                    </div>
                    <img class="image" src="/images/avatars/matt-1.jpg" alt="">
                </div>
            </div>
            <div class="msg-item clearfix msg-item-left">
                <div class="nt-item">
                    <img class="image" src="/images/avatars/matt-1.jpg" alt="">
                    <div>
                        <div class="show-name">Nibelung</div>
                        <div class="content">
                            Hello world!
                        </div>
                    </div>
                </div>
            </div>
            <div class="msg-item msg-item-right clearfix">
                <div class="nt-item">
                    <div class="content">
                        Hello world!
                    </div>
                    <img class="image" src="/images/avatars/matt-1.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="m-ft">
            <ul class="tool-tab">
                <li><i class="iconfont icon-face"></i></li>
                <li><i class="iconfont icon-cut" ></i></li>
                <li><i class="iconfont icon-file"></i></li>
            </ul>
            <div class="input-content">
                <input class="input" type="text" contenteditable="true" ref="input">
            </div>
            <div class="action">
                <span class="notice">按ctrl_enter发送</span>
                <a class="u-send" href="">发送</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatArea"
    }
</script>

<style scoped>
    .chat-area {
        height: 95%;
        position: relative;
    }
    .empty {
        text-align: center;
        padding: 20px;
        color: #bbb;
    }
    .box-hd {
        position: relative;
        padding: 10px 0;
        margin: 0 19px;
        border-bottom: 1px solid #d6d6d6;
        background-color: #eee;
        text-align: center;
        z-index: 1024;
    }
    .title {
        font-weight: 400;
        height: 25px;
        display: inline-block;
        font-size: 14px;
        line-height: 25px;
        cursor: pointer;
        position: relative;
    }
    .title::before{
        content: '';
        position: absolute;
        right: -14px;
        width: 6px;
        top: 7px;
        height: 6px;
        transform: rotate(45deg);
        border-bottom: 1px solid #333;
        border-right: 1px solid #333;
    }
    .title::after {
         content: '';
         position: absolute;
         right: -14px;
         width: 6px;
         top: 7px;
         height: 6px;
         transform: rotate(45deg);
         border-bottom: 1px solid #333;
         border-right: 1px solid #333;
     }
    .chat-bd {
        position: absolute;
        padding: 18px;
        height: 490px;
        box-sizing: border-box;
        top: 50px;
        right: 0;
        left: 0;
        overflow-y: auto;
    }
    .msg-item-left {
        margin-left: -500px;
        float: left;
    }
    .nt-item {
        display: flex;
    }
    .image {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        border-radius: 3px;
    }
    .show-name {
        font-size: 12px;
        color: #aaa;
        padding-bottom: 2px;
    }
    .content {
        max-width: 100%;
        padding: 10px 10px;
        background-color: #fff;
        position: relative;
    }
    .content::before {
         content: '';
         position: absolute;
         border: 5px solid #fff;
         top: 15px;
         left: -5px;
         transform: rotate(45deg);
     }
    .msg-item-right {
        float: right;
    }
    .nt-item {
        display: flex;
        justify-content: flex-end;
    }
    .image {
        width: 40px;
        height: 40px;
        margin-left: 10px;
        border-radius: 3px;
    }
    .input-content {
        max-width: 100%;
        padding: 10px 10px;
        /*background-color: #b1e281;*/
        /*position: relative;*/
    }
    /*&:before {*/
         /*content: '';*/
         /*position: absolute;*/
         /*border: 5px solid #b1e281;*/
         /*top: 15px;*/
         /*right: -5px;*/
         /*transform: rotate(45deg);*/
     /*}*/
    .msg-item {
        width: 660px;
        margin-bottom: 15px;
    }
    .m-ft {
        position: absolute;
        height: 180px;
        right: 0;
        bottom: 0;
        left: 0;
        border-top: 1px solid #d6d6d6;
        box-sizing: border-box;
        padding-right: 18px;
    }
    .tool-tab {
        padding: 5px 17px;
        display: flex;
    }
    li {
        list-style-type: none;
        height: 30px;
        width: 30px;
        line-height: 30px;
        margin-right: 10px;
        text-align: center;
    }
    i {
        cursor: pointer;
        font-size: 22px;
    }
    .content {
        margin-left: 17px;
    }
    .input {
        width: 100%;
        height: 80px;
        outline:none;
        overflow-y: auto;
    }
    .action {
        margin-top: 10px;
        margin-bottom: -80px;
        margin-left: 17px;
        display: flex;
        height: 30px;
        justify-content: flex-end;
        align-items: center;
        font-size: 14px;
    }
    .notice {
        margin-right: 10px;
        color: #999;
    }
    .u-send {
        text-decoration: none;
        background-color: #fff;
        padding: 5px 25px;
        border: 1px solid #aaa;
        border-radius: 3px;
        color: #666;
    }
</style>
