import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import AuthUser from './modules/user/auth'
import Login from './modules/user/login'
import Book from './modules/book'

export default new Vuex.Store({
    modules:{
        AuthUser,
        Login,
        Book
    }
})
