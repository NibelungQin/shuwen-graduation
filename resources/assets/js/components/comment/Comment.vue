<template>
    <div>
        <ul v-for="comment in comments">
            <li>
                {{comment.body}}
                <p>── <a href="">{{comment.user.name}}</a> ─ {{comment.created_at | ago}}</p>
            </li>
        </ul>
        <div class="comment-input">
            <el-input
                    type="textarea"
                    :rows="1"
                    v-model="body"
                    placeholder="使用评论询问更多信息或提出修改意见，请不要在评论里回答问题"
            ></el-input>
            <el-button @click="store">提交评论</el-button>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: "Comment",
        props: ['type','model'],
        data() {
            return {
                body: '',
                comments: [],
            }
        },
        filters: {
            //将时间转化为Y-m-d
            ago (date) {
                var d = new Date(date);
                return d.getFullYear()+ '年-' + (d.getMonth()+1)+ '月-' +d.getDate() + '日';
            }
        },
        computed:mapState({
            user: state=>state.AuthUser
        }),
        mounted(){
            axios.get('/api/' + this.type +'/' + this.model + '/comment').then(response=>{
                this.comments = response.data
            })
        },
        methods: {
            store(){
                axios.post('/api/comment', {
                    'type': this.type,
                    'model': this.model,
                    'body': this.body
                }).then(response => {
                    let comment = {
                        body: response.data.body,
                        created_at : response.data.created_at,
                        user: {
                            name: this.user.name
                        }
                    };
                    this.comments.push(comment);
                    this.body = '';
                })
            }
        }
    }
</script>

<style scoped>
    .comment-input {
        display: block;
    }
    li {
        display: inline-block;
        margin-left: -40px;
    }
</style>
