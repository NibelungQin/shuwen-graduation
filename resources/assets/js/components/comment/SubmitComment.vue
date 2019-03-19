<template>
    <div>
        <form autocomplete="off">
            <div class="item">
                <div class="item-content">
                    <div class="input-wrapper input-type">
                        <textarea
                                autocomplete="off"
                                spellcheck="false"
                                placeholder="请填写你的评论"
                                rows="2"
                                class="comment-input"
                                style="width:100%; height: 52px; min-height: 52px; max-height: 115px;">
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="item-content">
                    <button class="btn btn-primary">
                        <span>提交评论</span>
                    </button>
                </div>
            </div>
        </form>
    </div> <!---->
</template>

<script>
    export default {
        name: "CommentReply"
    }
</script>

<style scoped>
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
