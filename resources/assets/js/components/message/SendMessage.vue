<template>
    <div>
        <button
                class="btn btn-primary btn-sm"
                @click="showSendMessageForm"
        >发送私信</button>
        <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            发送私信
                        </h4>
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <textarea name="body" class="form-control" v-model="body"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="store">
                            发送私信
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SendMessage",
        props: ['user'],
        data() {
            return {
                body: '',
            }
        },
        methods: {
            store(){
                axios.post('/api/message/store',{
                    'user': this.user,
                    'body': this.body,
                }).then(response=>{
                    this.body = '';
                    this.$message({
                        showClose: true,
                        message: '私信发送成功',
                        type: 'success'
                    });
                    setTimeout(function () {
                        $('#modal-send-message').modal('hide');
                    },2000)
                })
            },
            showSendMessageForm(){
                $('#modal-send-message').modal('show');
            }
        }
    }
</script>

<style scoped>

</style>
