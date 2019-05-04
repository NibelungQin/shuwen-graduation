<template>
    <div>
        <h2><Icon type="md-settings"></Icon> 编辑个人资料</h2>
        <hr>
        <Form :model="form" :label-width="80">
            <FormItem label="用户名">
                <Input v-model="form.name" size="large" disabled></Input>
            </FormItem>
            <FormItem label="邮箱">
                <Input v-model="form.email" size="large" disabled></Input>
            </FormItem>
            <FormItem label="昵称">
                <Input v-model="form.nickname" size="large" placeholder="请输入您的昵称仅用户展示"></Input>
            </FormItem>
            <FormItem label="描述">
                <Input size="large" v-model="form.description" type="textarea" :autosize="{minRows: 5,maxRows: 10}" placeholder="请输入您的描述"></Input>
            </FormItem>
            <FormItem>
                <Button :loading="loading" style="color: #fff;background-color: #1abc9c;border-color: #1abc9c;"  @click="handleSubmit" long>
                    <span v-if="!loading">编辑资料</span>
                    <span v-else>Loading...</span>
                </Button>
            </FormItem>

        </Form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                form: {},
                loading: false,
                cut_avatar: false,
            }
        },
        created() {

        },
        methods: {
            handleSubmit() {
                this.loading = true

            },
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
</style>
