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
                                        <img class="rounded-circle" alt="">{{last(message)}}
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4></h4>
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
                messages: [1,2,3]
            }
        },
        computed:mapState({
            user: state=>state.AuthUser
        }),
        mounted() {
            axios.get('/api/inbox').then(response=>{

            })
        },
        methods: {
            last(last){
                // axios.post('/api/inbox/last')
                return last;
            }
        }
    }
</script>

<style scoped>
    .media.unread {
        background:#fff9ca;
    }
</style>
