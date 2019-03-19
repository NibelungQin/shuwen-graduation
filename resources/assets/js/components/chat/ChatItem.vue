<template>
    <div>
        <div class="chat-item current">
            <div class="avatar">
                <img src="/images/avatars/matt-1.jpg" alt="">
            </div>
            <div class="new-msg"></div>
            <div class="name">群聊</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatItem"
    }
</script>

<style scoped>
    .name {
        margin-left: 8px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        word-wrap: normal;
        font-weight: 400;
        font-size: 13px;
        color: #fff;
        line-height: 20px;
    }
    .current {
        background-color: #3a3f45;
    }
    .chat-item {
        display: flex;
        height: 60px;
        padding: 12px 18px;
        cursor: pointer;
    }
    .avatar {
        width: 50px;
        position: relative;
    }
    img {
        width: 40px;
        height: 40px;
        border-radius: 3px;
    }
    .new-msg {
        margin-left: -15px;
        margin-top: -5px;
        width:10px;
        height:10px;
        line-height:20px;
        font-size:10px;
        color:#fff;
        text-align:center;
        background-color:#f00;
        border-radius:50%;
        position:relative;
    }
</style>
