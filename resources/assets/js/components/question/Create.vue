<template>
    <div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        发布问题
                    </div>
                    <div class="card-body">
                        <el-form :model="formData" :rules="rules" ref="formData">
                            <el-form-item label="标题" prop="title">
                                <el-input
                                        v-model="formData.title"
                                        clearable
                                        placeholder="请输入标题"
                                ></el-input>
                            </el-form-item>
                            <el-form-item label="标签">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.topics"
                                        multiple
                                        filterable
                                        allow-create
                                        default-first-option
                                        remote
                                        :remote-method="moreTopics"
                                        placeholder="请选择相关话题">
                                    <el-option
                                            v-for="item in items"
                                            :key="item.id"
                                            :label="item.name"
                                            :value="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item>
                                <quill-editor
                                        v-model="formData.body"
                                        ref="myQuillEditor"
                                        :options="editorOption"
                                        @blur="onEditorBlur($event)"
                                        @focus="onEditorFocus($event)"
                                        @change="onEditorChange($event)">
                                </quill-editor>
                            </el-form-item>
                            <el-form-item>
                                <el-button class="btn-block" type="primary" @click="submitQuestion">提交</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import {quillEditor} from 'vue-quill-editor'
    import {quillRedefine} from 'vue-quill-editor-upload'
    export default {
        name: "Create",
        components: {
            quillEditor,
            quillRedefine
        },
        data() {
            return {
                formData:{
                    title: null,
                    topics:[],
                    body: null,
                },
                items: [],
                rules: {
                    'title': [
                        {required: true, message: '标题不能为空', trigger: 'blur'},
                        {min: 6, message: '标题长度不能小于6个字符', trigger: 'blur'}
                    ],
                },
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
        methods:{
            moreTopics(query){
                axios.get('/api/topics?' + 'q=' + query).then(response=>{
                    this.items = response.data
                })
            },
            submitQuestion(){
                let data = {
                    title: this.formData.title,
                    topics: this.formData.topics,
                    body: this.formData.body
                }
                axios.post('/api/questions',data).then(response => {
                    this.$router.push({name: 'questions'})
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
    .main-content {
        padding: 25px 0!important;
        /*background: #f5f5f1!important;*/
    }
    .quill-editor {
        height: 200px;
    }
    .btn-block {
        margin-top: 50px;
    }
</style>
