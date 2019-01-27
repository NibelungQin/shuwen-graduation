<template>
    <div id="container" class="container">
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item>首页</el-breadcrumb-item>
            <el-breadcrumb-item>1</el-breadcrumb-item>
            <el-breadcrumb-item>2</el-breadcrumb-item>
        </el-breadcrumb>

        <div class="menu">
            <el-button class="menu-btn" v-if="nightMode" @click="changeMode">
                <img src="../../assets/sun.svg">
                <span>日间模式</span>
            </el-button>
            <el-button class="menu-btn" @click="changeMode" v-else>
                <img src="../../assets/moon.svg">
                <span>夜间模式</span>
            </el-button>
            <el-button class="menu-btn">
                <img src="../../assets/setting.svg">
                <span>设置</span>
            </el-button>
            <el-button class="menu-btn" @click="showChapter">
                <img src="../../assets/list.svg">
                <span>目录</span>
            </el-button>
        </div>
        <div class="content" :class="{'night-mode':nightMode}">
            <h3>test</h3>
            <article v-html="">777</article>
        </div>

        <!--<div class="chapter-list" v-show="isShowChapter" v-scroll="onScroll">-->
            <!--<div class="chapter-contents">-->
                <!--<p>{{$store.state.bookInfo.title}}：目录</p>-->
                <!--<v-touch tag="span" class="chapter-sort" @tap="descSort">-->
                    <!--<img src="../../assets/down.svg" v-if="!chapterDescSort">-->
                    <!--<img src="../../assets/up.svg" v-else>-->
                <!--</v-touch>-->
            <!--</div>-->
            <!--<ul id="chapter-list" v-if="loadedChapters">-->
                <!--<v-touch tag="li" v-for="(chapter, index) in loadedChapters" :key="index" @tap="jumpChapter(index)">{{chapter.title}}</v-touch>-->
            <!--</ul>-->
        <!--</div>-->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                bookChapter: {},
                bookChaptersContent: '',
                loadedChapters: [], // 缓存滚动加载的章节列表
                loadPages: 1, // 滚动加载的记次
                firstLoad: true, // 首次加载标识符
                operation: false, // 显示操作界面标识符
                currentChapter: 0,
                nightMode: false, // 夜间/日间模式却换
                isShowChapter: false, // 是否显示目录
                chapterDescSort: false // 是否降序排列
            }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .container {
        background: #dad9d4;
        /*color: #000;*/
    }
    .content {
        /*min-height: 100vh;*/
    }
    article {
        font-size: 0.9rem;
        line-height: 1.7rem;
        padding: 0 1rem;
    }
    h3 {
        text-align: center;
        margin-top: 0;
    }
    .head {
        background: #000;
        color: #f3e7e7;
    }
    .menu {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        left: 0;
        height: 2.5rem;
        width: 100%;
    }
    .menu img {
        color: #fff;
        width: 1rem;
        height: 1rem;
        align-self: center;
    }
    .menu-btn {
        flex-direction: column;
        justify-content: center;
        color: #f3e7e7;
        text-align: center
    }
    .menu-btn i {
        font-size: 1.6rem;
    }
    .menu-btn span {
        font-size: 0.6rem;
    }
    .arrow-left {
        position: absolute;
        left: 1rem;
        line-height: 3rem;
        font-size: 1.5rem;
    }
    .night-mode {
        background: #383434;
        color: #807d7d;
    }
    .chapter-list {
        position: absolute;
        top: 0;
        left: 0;
        height: 100vh;
        overflow: auto;
        background: #fff;
        width: 80vw;
        z-index: 10;
    }
    .chapter-list ul {
        margin-top: 2.5rem;
    }
    .chapter-list li {
        padding-left: 1rem;
        line-height: 2rem;
        border-bottom: 1px solid #f2f2f2;
    }
    .chapter-contents {
        position: fixed;
        top: 0;
        left: 0;
        width: 80vw;
        background: #fff;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding-left: 1rem;
        box-sizing: border-box;
    }
    .chapter-sort {
        margin-right: 1.5rem;
        align-self: center;
    }
    .chapter-sort img {
        width: 1rem;
        height: 1rem;
    }
</style>
