<template>
    <div class="container">
        <div class="select" id="select" :class="isFixed== true?'isFixed':''">
            <ul class="select-bar">
                <el-button v-for="(item, index) in types" :class="{'active': index === majorSelected}" :key="index" @click="setType(item.type,index)">{{item.name}}</el-button>
            </ul>
            <ul class="select-bar" v-if="mins">
                <el-button :class="{'active': index === minorSelected}" v-for="(minor, index) in mins" :key="index" @click="setMinor(minor,index)">{{minor}}</el-button>
            </ul>
        </div>
        <div>
            <ul class="book-list">
                <book-list v-for="book in books" :book="book" :key="book._id"></book-list>
            </ul>
        </div>
    </div>
</template>

<script>
    import Api from '../../api/novel'
    import BookList from '../common/BookList'
    export default {
        components: {
            BookList,
        },
        data () {
            return {
                books: null,
                type: 'hot',
                gender: '',
                major: '',
                minor: '',
                mins: null,
                majorSelected: 0,
                minorSelected: 0,
                currentPage: 1,
                allLoaded: false,
                types: [{
                    type: 'hot',
                    name: '热门'
                }, {
                    type: 'new',
                    name: '新书'
                }, {
                    type: 'reputation',
                    name: '好评'
                }, {
                    type: 'over',
                    name: '完结'
                }, {
                    type: 'monthly',
                    name: '包月'
                }],

                offsetTop: '',
                offsetHeight: '',
                isFixed: false,
            }
        },
        mounted(){
            // handleScroll为页面滚动的监听回调
            window.addEventListener('scroll', this.handleScroll)
        },
        destroyed(){
            //移除监听
            window.removeEventListener('scroll', this.handleScroll)
        },
        methods: {
            handleScroll(){
                // 监听dom渲染完成
                this.$nextTick(function(){
                    let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                    let headerTop = document.getElementById("select");
                    if (scrollTop > 10) {
                        this.isFixed = true;
                    } else {
                        this.isFixed = false;
                    }
                });
            },

            /**
             * 根据筛选分类获取结果
             */
            // todo 入参需要优化
            getNovelListByCat (gender, type, major, minor) {
                // Indicator.open('加载中')
                Api.getNovelListByCat(gender, type, major, minor).then(response => {
                    // Indicator.close()
                    this.books = response.data.books
                }).catch(err => {
                    console.log(err)
                })
            },
            /**
             * 选择大类分类
             */
            setType (type, index) {
                this.majorSelected = index
                this.type = type
                this.getNovelListByCat(this.gender, this.type, this.major, this.minor)
            },
            /**
             * 选择子类分类
             */
            setMinor (minor, index) {
                this.minorSelected = index
                this.minor = minor
                this.getNovelListByCat(this.gender, this.type, this.major, this.minor)
            },
        },
        beforeRouteEnter (to, from, next) {
            next(vm => {
                vm.major = vm.$route.query.major
                vm.gender = vm.$route.query.gender
                /**
                 * 获取大分类中的小类别
                 */
                Api.getCategoryDetail().then(response => {
                    response.data[vm.$route.query.gender].forEach((type) => {
                        if (type.major === vm.$route.query.major) {
                            vm.mins = type.mins
                        }
                    })
                }).catch(err => {
                    console.log(err)
                })
                vm.getNovelListByCat(vm.$route.query.gender, vm.type, vm.$route.query.major)
                // vm.$store.commit(SET_BACK_POSITION, '分类')
            })
        },
    }
</script>

<style scoped>
    .isFixed{
        position: fixed;
        top: 0px;
        z-index: 4;
        width: 100%;
    }
    .select {
        /*position: fixed;*/
        /*top: 2rem;*/
        left: 0;
        background: #fff;
        /*z-index: 10;*/
    }
    .select-bar {
        display: flex;
        /*flex-direction: row;*/
        /*justify-content: flex-start;*/
        /*flex-wrap: nowrap;*/
        height: 2rem;
        /*width: 100vw;*/
        /*overflow-x: auto;*/
        /*overflow-y: hidden;*/
        border-bottom: 1px solid #f2f2f2;
    }
    .select-bar li {
        flex-shrink: 0;
        line-height: 2rem;
        padding-left: 0.6rem;
        padding-right: 0.6rem;
        font-size: 0.7rem;
    }
    .active {
        color: red;
    }
    .book-list {
        position: relative;
        width: 100vw;
        background: #f2f2f2;
    }
    .loadmore {
        margin-top: 6rem;
    }
    .active {
        color: #26a2ff;
    }
</style>
