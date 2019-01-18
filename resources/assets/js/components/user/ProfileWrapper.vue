<template>
    <div class="container">
        <el-row :gutter="20">
            <el-col :span="6">
                <div class="list-group">
                    <router-link :to="{name: 'profile'}" class="list-group-item" active-class="active" exact>个人资料</router-link>
                    <router-link :to="{name: 'profile'}" class="list-group-item" active-class="active" exact>修改资料</router-link>
                    <router-link :to="{name: 'profile'}" class="list-group-item" active-class="active" exact>修改密码</router-link>
                </div>
            </el-col>
            <el-col :span="18">
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: "ProfileWrapper"
    }
</script>

<style scoped>
    .list-group-item{
        /*width: 150px;*/
    }
</style>
