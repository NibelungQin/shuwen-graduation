<template>
    <div style="margin-top: 20px;">
        <div v-for="(comment, key) in collections">
            <comment-child
                    :commentable_id="commentable_id"
                    :comment_key="key"
                    :user_id="user_id"
                    :commentable_type="commentable_type"
                    :canComment="canComment"
                    :comments="comments"
                    :comment="comment">
            </comment-child>
        </div>
    </div>

</template>
<script>
    export default{
        name: 'CommentRoot',
        props:['collections','comments','user_id','commentable_id', 'commentable_type', 'canComment']
    }
</script>