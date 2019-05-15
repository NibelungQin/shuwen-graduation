<template>
    <div class="container">
        <Row>
            <Form :model="form" ref="form" :rules="ruleValidate">
                <Col span="15">
                    <Card>
                        <FormItem label="标题" prop="title">
                            <Input icon="android-list" v-model="form.title"/>
                        </FormItem>
                        <FormItem label="内容">
                        </FormItem>
                        <FormItem prop="content" style="height: 495px;margin-top:-25px">
                            <quill-editor
                                    ref="myQuillEditor"
                                    v-model="form.content"
                                    :options="editorOption"
                                    @blur="onEditorBlur($event)"
                                    @focus="onEditorFocus($event)"
                                    @change="onEditorChange($event)">
                            </quill-editor>
                        </FormItem>
                    </Card>
                </Col>
                <Col span="9" style="padding-left: 10px">
                    <Card>
                        <p slot="title">
                            <Icon type="paper-airplane"></Icon>
                            选项
                        </p>
                        <FormItem label="标签">
                            <el-select
                                    style="width: 100%"
                                    v-model="form.topics"
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
                        </FormItem>
                        <FormItem label="描述" prop="description">
                            <Input type="textarea" v-model="form.description"></Input>
                        </FormItem>
                    </Card>
                    <Card style="margin-top: 10px">
                        <p slot="title">
                            <Icon type="paper-airplane"></Icon>
                            发布
                        </p>
                        <FormItem label="封面" prop="image">
                            <image-cover :image="form.image" @successUpload="handleImageSuccess"></image-cover>
                        </FormItem>
                        <FormItem label="时间" prop="published_at">
                            <DatePicker format="yyyy-MM-dd HH:mm:ss" type="datetime" :value="form.published_at" @on-change="changeDate"></DatePicker>
                        </FormItem>
                        <Row>
                            <Col span="11">
                                <FormItem label="原创">
                                    <i-switch size="large" :value="true" v-model="form.is_original" :true-value="1" :false-value="0">
                                        <span slot="open">是</span>
                                        <span slot="close">否</span>
                                    </i-switch>
                                </FormItem>
                            </Col>
                        </Row>

                        <FormItem>
                            <Button @click="onSubmit" type="success" long>发布</Button>
                        </FormItem>
                    </Card>
                </Col>
            </Form>
        </Row>
    </div>
</template>

<script>
    import {quillEditor} from 'vue-quill-editor'
    import {quillRedefine} from 'vue-quill-editor-upload'
    import ImageCover from '../common/ImageCover'
    export default {
        components: {
            quillEditor,
            quillRedefine,
            ImageCover
        },
        data() {
            return {
                items: [],
                editorOption: null,
                form: {
                    title: '',
                    content: '',
                    topics: [],
                    description: '',
                    image: '',
                    published_at: '',
                    is_original: 1
                },
                ruleValidate: {
                    title: [
                        {required: true, message: '文章标题不能为空'}
                    ],
                    content: [
                        {required: true, message: '文章内容不能为空'}
                    ],
                    tags: [
                        {required: true, message: '请选择文章标签'}
                    ],
                    description: [
                        {required: true, message: '文章描述不能为空'}
                    ],
                    image: [
                        {required: true, message: '文章封面图片不能为空'}
                    ],
                    published_at: [
                        {required: true, message: '请选择文章发布时间'}
                    ]
                },
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
            handleImageSuccess(response) {
                this.form.image = response;
            },
            changeDate(date) {
                this.form.published_at = date
            },
            onSubmit(){
                let data = {
                    title: this.form.title,
                    topics: this.form.topics,
                    content: this.form.content,
                    image: this.form.image,
                    description: this.form.description,
                    is_original: this.form.is_original,
                    published_at: this.form.published_at,
                }
                this.$refs.form.validate((valid)=>{
                    if (valid) {
                        axios.post('/api/articles', data).then(response => {
                            this.$Message.success('发表文章成功!');
                            this.$router.push({name: 'articles'})
                            // console.log(this.$refs.image.imgDataUrl)
                        })
                    } else {
                        this.$Message.error('表单信息不完善!');
                    }
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
    .container{
        margin-top: 40px;
    }
    .quill-editor {
        height: 400px;
    }
</style>