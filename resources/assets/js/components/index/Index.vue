<template>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <carousel></carousel>
                </div>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <articles></articles>
                    </div>
                    <div class="col-md-12">
                        <questions></questions>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-12">
                        <recommend></recommend>
                    </div>
                    <div class="col-md-12">
                        <read-log></read-log>
                    </div>
                </div>
            </div>
        </div>
        <Modal v-if="is_first" v-model="show" width="360">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>最新阅读记录</span>
            </p>
            <div style="text-align:center">
                <p>上次的阅读内容是</p>
                <p style="color:#15b982;font-size: 16px">{{read.readable.title}}</p>
                <p>是否继续阅读？</p>
            </div>
            <div slot="footer">
                <Button type="error" size="large" long :loading="modal_loading" @click="log">阅读</Button>
            </div>
        </Modal>
    </div>
</template>

<script>
    import Carousel from './Carousel'
    import ReadLog from './ReadLog'
    import Recommend from './Recommend'
    import Articles from './Articles'
    import Questions from './Questions'
    import JWT from '../../helpers/jwt'
    export default {
        name: "Index",
        components: {
            Carousel,
            ReadLog,
            Recommend,
            Articles,
            Questions
        },
        data() {
            return {
                is_first: false,
                read: '',
                modal_loading: false,
            }
        },
        computed: {
            is_login(){
                return JWT.getToken() ? true : false
            },
            show(){
                return this.is_login && this.is_first
            }
        },
        created() {
            axios.get('/api/home/readLog').then(response=>{
                this.is_first = response.data.status
                this.read = response.data.read
            })
        },
        methods: {
            log() {
                this.modal_loading = true;
                setTimeout(() => {
                    this.modal_loading = false;
                    this.show = false;
                    this.$Message.success('进入阅读记录数据成功');
                    if (this.read.type == 'Article'){
                        this.$router.push({name: 'article_show',params: {id: this.read.readable_id}})
                    }else {
                        this.$router.push({name: 'questionShow',params: {id: this.read.readable_id}})
                    }
                }, 100);
            }
        }
    }
</script>

<style scoped>
    .main-content {
        height: 100%;
        padding: 25px 0!important;
        background: #f5f5f1!important;
    }
</style>