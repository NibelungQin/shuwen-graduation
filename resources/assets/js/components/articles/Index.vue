<template>
    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!--<router-link>-->
                        <Card>
                            <div>
                            </div>
                            <!--<v-card-media-->
                                    <!--class="white&#45;&#45;text"-->
                                    <!--height="200px"-->
                                    <!--:src="article.page_image"-->
                            <!--&gt;-->
                                <!--<v-container fill-height fluid>-->
                                    <!--<v-layout fill-height>-->
                                        <!--<v-flex xs12 align-end flexbox>-->
                                            <!--<span class="headline">{{ article.title }}</span>-->
                                        <!--</v-flex>-->
                                    <!--</v-layout>-->
                                <!--</v-container>-->
                            <!--</v-card-media>-->
                        </Card>
                    <!--</router-link>-->
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>
    .main-content {
        height: 100%;
        padding: 25px 0!important;
        background: #f5f5f1!important;
    }
</style>