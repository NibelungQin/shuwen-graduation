<template>
    <div>
        <h2><Icon type="md-photos"></Icon> 编辑头像</h2>
        <hr>
        <label for="exampleInputFile">请选择图片：</label>
        <img id="preview-img" class="avatar-preview-img" :src="user.avatar">
        <input type="file" accept="image/png, image/jpeg, image/gif, image/jpg" class="fileinput"  @change="previewModel" />
        <Modal title="裁剪头像" ok-text="裁剪" :loading="true" :mask-closable="false" @on-ok="handelCut" v-model="cut_avatar">
            <Row :gutter="10">
                <Col span="14" class="image-editor-con">
                    <div class="cropper">
                        <img id="cropimg" alt="">
                    </div>
                </Col>
                <Col span="10" class="image-editor-con">
                    <Row type="flex" justify="center" align="middle" class="image-editor-con-preview-con">
                        <div id="preview"></div>
                    </Row>
                </Col>
            </Row>
        </Modal>
        <br>
        <Button :loading="loading" style="color: #fff;background-color: #1abc9c;border-color: #1abc9c;"  @click="handleSubmit" >
            <span v-if="!loading">上传头像</span>
            <span v-else>Loading...</span>
        </Button>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Cropper from 'cropperjs'
    export default {
        data() {
            return {
                loading: false,
                cut_avatar: false,
                cropper: {},
                avatar: ''
            }
        },
        computed:{
            ...mapState({
                user: state=>state.AuthUser
            })
        },
        mounted() {
            let img = document.getElementById('cropimg');
            this.cropper = new Cropper(img, {
                dragMode: 'move',
                preview: '#preview',
                restore: false,
                center: false,
                highlight: false,
                cropBoxMovable: false,
                toggleDragModeOnDblclick: false
            });
        },
        methods: {
            handleSubmit() {
                this.loading = true;
                // this.$http.put('users/' + this.$route.params.name + '/avatar', {avatar: this.avatar}).then((response) => {
                    this.$Message.success('修改成功')
                //     this.$store.commit('modifyAvatar', this.avatar);
                //     this.loading = false
                // })
            },
            previewModel(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = () => {
                    this.cropper.replace(reader.result);
                    reader.onload = null;
                };

                reader.readAsDataURL(file);
                this.cut_avatar = true;
            },
            handelCut() {
                let vm = this;
                vm.cropper.getCroppedCanvas().toBlob(function (blob) {
                    var formData = new FormData();
                    formData.append('image', blob);

                    // vm.$http.post('upload/image', formData).then((response) => {
                    //     vm.avatar = response.relative_url
                    //     vm.cut_avatar = false
                    // })
                });
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
</style>
