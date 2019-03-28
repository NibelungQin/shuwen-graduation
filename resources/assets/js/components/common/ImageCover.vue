<template>
    <div>
        <div @click="toggleShow" style="width: 80px;height:80px;margin-left: 45px;margin-top: 40px;border:1px dashed #000;">
            <Icon v-if="imgDataUrl==''" type="ios-camera" size="20" style="margin-left: 30px;margin-top: 30px;"></Icon>
            <img v-else :src="imgDataUrl" style="width: 80px;">
        </div>
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
    </div>
</template>

<script>
    // import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    import jwtToken from '../../helpers/jwt'
    export default {
        props: ['image'],
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
                // imgDataUrl: ''
            }
        },
        computed: {
            imgDataUrl() {
                return this.image
            }
        },
        components: {
            'my-upload': myUpload
        },
        methods: {
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