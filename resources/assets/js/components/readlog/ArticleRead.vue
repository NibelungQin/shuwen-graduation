<template>
    <div class="section__3bS4">
        [文章]
        <router-link :to="'/articles/' + id">
            {{title}}
        </router-link>
        <span class="meta">
            • {{ created_diff }}
        </span>
    </div>
</template>

<script>
    export default {
        name: "ArticleRead",
        props: ['id','title','created_diff'],
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
    .not_read_at{
        background-color:#f5f5f1;
        border-bottom: 1px solid #ffffff;
    }
</style>