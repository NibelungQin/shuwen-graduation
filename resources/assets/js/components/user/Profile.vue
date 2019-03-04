<template>
    <div class="container">
        <div class="card">
            <ul class="list-group">
                <li class="list-group-item">
                    <img class="rounded-circle" :src="user.avatar" alt="" style="width: 50px">
                    <el-button type="success">更改头像</el-button>
                </li>
                <li class="list-group-item">
                    用户名
                    <h6>{{ user.name }}</h6>
                </li>
                <li class="list-group-item">
                    邮箱
                    <br>
                    <h6>{{ user.email }}</h6>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: "Profile",
        created() {
            this.$store.dispatch('setAuthUser')
        },
        computed:mapState({
            user: state => state.AuthUser
        })
    }
</script>

<style scoped>

</style>
