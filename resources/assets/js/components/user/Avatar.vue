<template>
    <div>
        <h2><Icon type="md-photos"></Icon> 编辑头像</h2>
        <hr>
        <label for="exampleInputFile">请选择图片：</label>
        <img id="preview-img" class="avatar-preview-img" :src="imgDataUrl" @click="toggleShow">
        <my-upload field="img"
                   @crop-success="cropSuccess"
                   @crop-upload-success="cropUploadSuccess"
                   @crop-upload-fail="cropUploadFail"
                   v-model="show"
                   :width="300"
                   :height="300"
                   url="/api/upload/img"
                   :params="params"
                   :headers="headers"
                   img-format="png">
        </my-upload>
        <br>
        <Button :loading="loading" style="color: #fff;background-color: #1abc9c;border-color: #1abc9c;"  @click="handleSubmit" >
            <span v-if="!loading">上传头像</span>
            <span v-else>Loading...</span>
        </Button>
    </div>
</template>

<script>
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    import jwtToken from '../../helpers/jwt'
    export default {
        components: {
            'my-upload': myUpload
        },
        data() {
            return {
                show: false,
                params: {
                    _token: jwtToken.getToken(),
                    name: 'img'
                },
                headers: {
                    smail: '*_~'
                },

                loading: false,
                imgDataUrl: ''
            }
        },
        created(){
            setTimeout(() => {
                this.imgDataUrl = this.$store.state.AuthUser.avatar
            }, 1000)
        },
        methods: {
            handleSubmit() {
                this.loading = true;
                axios.put('/api/users/' + this.$route.params.name + '/avatar', {avatar: this.imgDataUrl}).then((response) => {
                    this.$Message.success('修改成功')
                    this.loading = false
                })
            },
            toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(response, field){
                this.imgDataUrl = response.imgUrl
                this.$emit('successUpload', response.imgUrl)
                this.toggleShow()
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        }
    }
</script>

<style scoped>
    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #e4e4e4;
    }
    label {
        display: block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .avatar-preview-img {
        padding: 3px;
        border: 1px solid #c8dcdb;
        border-radius: 6px;
        width:300px;
    }
    .fileinput{
        display:block;
    }
    .image-editor-con{
        height: 300px;
    }
    .image-editor-con .cropper{
        box-sizing: border-box;
        border: 1px solid #c3c3c3;
        width: 100%;
        height: 100%;
    }
    .image-editor-con .cropper img{
        max-height: 100%;
    }
    .image-editor-con-preview-con{
        width: 100% !important;
        height: 200px !important;
        border: 1px solid #c3c3c3;
    }
    #preview{
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    .filelabe{
        display: block;
        padding: 6px 15px;
        background: #2d8cf0;
        display: inline-block;
        border: 1px solid #2d8cf0;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        font-size: 12px;
        text-align: center;
        transition: all .2s;
    }
    .filelabe:hover{
        background: #5cadff;
        border: 1px solid #5cadff;
        transition: all .2s;
    }
</style>
