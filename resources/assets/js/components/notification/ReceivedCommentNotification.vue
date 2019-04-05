<template>
    <div class="section__3bS4" :class="read_at ? '' : 'not_read_at'">
        <div class="tip">
            <div class="media">
                <router-link :to="'/users/' + name">
                    <img :src="avatar" class="avatar rounded-circle" style="width: 40px; height: 40px; background: rgb(255, 255, 255); padding: 3px; border: 1px solid rgb(197, 197, 197);">
                </router-link>
                <div class="media-body" style="margin-top: 10px;margin-left: 5px;">
                    <router-link :to="'/users/' + name">
                        {{ name }}
                    </router-link>
                    •
                    在
                    <router-link :to="'/articles/' + slug">{{ title }}</router-link>
                    的评论提及了你
                    <span class="meta"> • {{ created_diff }}</span>
                    <div class="markdown" style="font-size: 14px;margin-top: 5px" v-html="body"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['avatar', 'title', 'name', 'created_diff', 'body', 'read_at', 'slug'],
    }
</script>

<style scoped>
    .meta, .operate {
        color: #a9a7a7;
        font-size: 12px;
    }
    .section__3bS4 a {
        color: #15b982;
    }
    .section__3bS4 .tip{
        margin-bottom: 10px;
    }
    .not_read_at{
        background-color:#f5f5f1;
        border-bottom: 1px solid #ffffff;
    }
</style>