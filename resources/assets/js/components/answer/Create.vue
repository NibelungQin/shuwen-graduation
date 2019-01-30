<template>
    <div class="container">
        <quill-editor
                v-model="body"
                ref="myQuillEditor"
                :options="editorOption"
                @blur="onEditorBlur($event)"
                @focus="onEditorFocus($event)"
                @change="onEditorChange($event)">
        </quill-editor>
        <button
                class="btn btn-primary btn-block"
                @click="submitAnswer"
        >提交</button>
    </div>
</template>

<script>
    import {quillEditor} from 'vue-quill-editor'
    import {quillRedefine} from 'vue-quill-editor-upload'
    export default {
        components: {
            quillEditor,
            quillRedefine
        },
        props: ['question'],
        data() {
            return {
                body: null,
                editorOption: null
            }
        },
        //上传图片到服务器（不使用base64）
        created() {
            this.editorOption = quillRedefine(//修改富文本编辑器图片上传路径
                {
                    // 图片上传的设置
                    uploadConfig: {
                        action: '/api/upload/img',  // 必填参数 图片上传地址
                        res: (response) => {
                            return response.imgUrl;//return图片url
                        },
                        name: 'img',  // 图片上传参数名
                        accept: 'image/png, image/gif, image/jpeg, image/bmp, image/x-icon',  // 可选参数 可上传的图片格式
                    },
                    toolOptions:[
                        { 'header': [1, 2, 3, 4, 5, 6, false] },
                        'bold', 'italic', 'underline', 'strike',
                        { 'header': 1 }, { 'header': 2 },
                        { 'list': 'ordered' }, { 'list': 'bullet' },
                        'image',
                    ],
                    placeholder: '请输入内容',
                }
            )
        },
        methods: {
            submitAnswer(){
                axios.post('/api/questions/' + this.$route.params.id + '/answer', {'body': this.body}).then(response=>{
                    this.body = ''
                })
            },
            onEditorBlur(){//失去焦点事件
            },
            onEditorFocus(){//获得焦点事件
            },
            onEditorChange(){//内容改变事件
            }
        }
    }
</script>

<style scoped>
    .btn{
        margin-top: 60px;
        margin-bottom: 40px;
    }
    .quill-editor {
        height: 100px;
    }
</style>
