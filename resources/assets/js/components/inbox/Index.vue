<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">私信列表</div>
                    <div class="card-body">
                        <div v-for="message in messages">
                            <div class="media" :class="{'unread' : read}">
                                <div>
                                    <a href="#">
                                        <img v-if="user.id == message[0].to_user_id" class="rounded-circle" :src="message[0].from_user.avatar" alt="" style="width:50px">
                                        <img v-else class="rounded-circle" :src="message[0].to_user.avatar" alt="" style="width:50px">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4>
                                        <a href="" v-if="user.id == message[0].to_user_id">
                                            {{message[0].to_user.name}}
                                        </a>
                                        <a href="" v-else>
                                            {{message[0].from_user.name}}
                                        </a>
                                    </h4>
                                    <p>
                                        <a :href="/inbox/+ message[0].dialog_id">
                                            {{message[0].body}}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: "Index",
        data() {
            return {
                messages: [],
                read: true
            }
        },
        computed:mapState({
            user: state=>state.AuthUser
        }),
        mounted() {
            axios.get('/api/inbox').then(response=>{
                this.messages = response.data.messages
            })
        },
        methods: {

        }
    }
</script>

<style scoped>
    .media.unread {
        background:#fff9ca;
    }
</style>
