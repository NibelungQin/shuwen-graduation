
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './routes';
import store from './store';
import jwtToken from './helpers/jwt'
import App from './components/app';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

import iView from 'iview';
import 'iview/dist/styles/iview.css';

import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'

import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import 'zico/css/zico.css'

//添加头部用户认证信息
axios.interceptors.request.use(function (config) {
    if (jwtToken.getToken()) {
        config.headers['Authorization'] = 'Bearer ' + jwtToken.getToken();
    }
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(ElementUI);
Vue.use(iView);
Vue.use(Vuetify);
Vue.use(VueQuillEditor);
Vue.component('app',App);

Vue.component('comment-post', require('./components/comment/CommentPost.vue'));
Vue.component('comment-root', require('./components/comment/CommentRoot.vue'));
Vue.component('comment-child', require('./components/comment/CommentChild.vue'));

const app = new Vue({
    el: '#app',
    router,
    store
});
