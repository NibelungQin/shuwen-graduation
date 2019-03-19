<template>
    <div style="margin-top: 20px">
        <div>
            <div>
                <div class="ui threaded comments trigger">
                    <div class="flex comment md12">
                        <a href="" class="avatar avatar-large">
                            <img style="width: 40px" src="/images/avatars/matt-1.jpg">
                        </a>
                        <div class="comment_content">
                            <a href="" class="author">qt</a>
                            <div class="metadata">
                                <span class="date" style="font-weight: 700;">9个月前</span>
                            </div>
                            <div class="text Post-body">
                                <div style="margin-top: 2px;">
                                    <div>
                                        <div class="markdown">
                                            <p>23333</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <a class="reply" @click="show_reply">回复</a>
                                <a class="reply">删除</a>
                            </div>
                            <div v-show="is_show" style="margin-top: 10px;">
                                <form autocomplete="off">
                                    <div class="item">
                                        <div class="item-content">
                                            <div class="input-wrapper input-type">
                                                <textarea
                                                        autocomplete="off"
                                                        spellcheck="false"
                                                        placeholder="输入回复信息"
                                                        rows="2"
                                                        class="comment-input"
                                                        style="width:100%; height: 52px; min-height: 52px; max-height: 115px;">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="item-content">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <span>立即回复</span>
                                            </button>
                                            <button  @click="show_reply" type="button" class="btn btn-secondary btn-sm" style="margin-left: 8px;">
                                                <span>取消回复</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentChild",
        data() {
            return {
                is_show: false,
            }
        },
        methods: {
            show_reply() {
                this.is_show = !this.is_show
            }
        }
    }
</script>

<style scoped>
    .ui.comments:first-child {
        margin-top: 0;
    }
    .ui.comments:last-child {
        margin-bottom: 0;
    }
    .ui.comments {
        font-size: 1em;
        margin: 1.5em 0;
        padding-bottom: 15px;
    }
    .comments {
        clear: both;
    }
    .ui.comments .comment :first-child {
        margin-top: 0;
        padding-top: 0;
    }
    .ui.comments .comment {
        position: relative;
        background: none;
        margin: .5em 0 0;
        padding: .5em 0 0;
        border: none;
        border-top: none;
        line-height: 1.2;
    }
    .flex {
        padding: 12px;
    }
    .avatar-large {
        width: 3.5em;
    }
    .ui.comments .comment .avatar {
        display: block;
        width: 3em;
        height: auto;
        float: left;
        margin: .2em 0 0;
    }
    a {
        cursor: pointer;
    }
    .avatar {
        align-items: center;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        position: relative;
        text-align: center;
        vertical-align: middle;
    }
    .comment_content {
        margin-left: 4.5em;
    }
    .author {
        font-size: 1em;
        color: #15b982;
        font-weight: 700;
    }
    .metadata {
        display: inline-block;
        margin-left: .5em;
        color: rgba(0,0,0,.4);
        font-size: .875em;
    }
    .text {
        margin: .25em 0 .5em;
        font-size: 1em;
        word-wrap: break-word;
        color: rgba(0,0,0,.87);
        line-height: 1.3;
    }
    .Post-body {
        font-size: 18px;
        line-height: 1.6;
        position: relative;
        overflow: auto;
    }
    .markdown {
        color: #636b6f;
        overflow: hidden;
        line-height: 2;
        word-wrap: break-word;
        font-size: 14px;
    }
    .actions {
        font-size: .9em;
        font-weight: 600;
    }
    .actions a {
        cursor: pointer;
        display: inline-block;
        margin: 0 .75em 0 0;
        color: rgba(0,0,0,.4);
    }
    .item{
        margin-bottom: 10px;
        vertical-align: top;
        zoom: 1;
    }
    .item-content{
        position: relative;
        line-height: 32px;
        font-size: 12px;
    }
    .input-wrapper{
        display: inline-block;
        width: 100%;
        position: relative;
        vertical-align: middle;
        line-height: normal;
    }
    textarea.comment-input {
        max-width: 100%;
        height: auto;
        min-height: 32px;
        vertical-align: bottom;
        font-size: 14px;
    }
    .comment-input {
        display: inline-block;
        width: 100%;
        height: 32px;
        line-height: 1.5;
        padding: 4px 7px;
        font-size: 12px;
        border: 1px solid #dddee1;
        border-radius: 4px;
        color: #495060;
        background-color: #fff;
        background-image: none;
        position: relative;
        cursor: text;
        transition: border .2s ease-in-out,background .2s ease-in-out,box-shadow .2s ease-in-out;
    }
</style>
