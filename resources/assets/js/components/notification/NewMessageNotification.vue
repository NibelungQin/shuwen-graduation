<template>
    <div class="section__3bS4" :class="read_at ? '' : 'not_read_at'">
        <router-link :to="'/users/' + name">
            <img :src="avatar" class="avatar rounded-circle" style="width: 40px; height: 40px; background: rgb(255, 255, 255); padding: 3px; border: 1px solid rgb(197, 197, 197);">
        </router-link>
        <router-link :to="'/users/' + name">
            {{ name }}
        </router-link>
        •
        <a @click="about">
            给你发送了一条私信
        </a>
        <span class="meta">
            • {{ created_diff }}
        </span>
    </div>
</template>

<script>
    export default {
        name: "NewMessageNotification",
        props: ['id','userId','dialog_id','avatar', 'name','read_at','created_diff'],
        data() {
            return {
                read: true,
            }
        },
        methods: {
            about(){
                if (this.read){
                    axios.get('/api/notifications/' + this.id)
                        .then(response=>{
                            this.$router.push({
                                name: 'inboxShow',
                                params: {
                                    id: this.dialog_id,
                                    userId: this.userId,
                                }
                            })
                        })
                } else {
                    this.$router.push({
                        name: 'inboxShow',
                        params: {
                            id: this.dialog_id,
                            userId: this.userId,
                        }
                    })
                }
            }
        }
    }
</script>

<style scoped>
    .meta, .operate {
        color: #a9a7a7;
        font-size: 12px;
    }
    .section__3bS4 a {
        color: #15b982;
    }
    .not_read_at{
        background-color:#f5f5f1;
        border-bottom: 1px solid #ffffff;
    }
</style>
