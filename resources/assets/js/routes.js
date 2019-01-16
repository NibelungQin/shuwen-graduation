import VueRouter from 'vue-router'
import Store from './store'
import JWT from './helpers/jwt'
let routes = [
    {
        path: '/',
        name: 'home',
        component: require('./components/user/profile'),//profile暂时作为主页
        meta: {}
    },
    {
        path: '/login',
        name: 'login',
        component: require('./components/login/Login'),
        meta: {requireGuest: true}
    },
    {
        path: '/register',
        name: 'register',
        component: require('./components/register/Register'),
        meta: {requireGuest: true}
    },
    {
        path: '/book/category',
        name: 'bookCategory',
        component: require('./components/category/BookCategory'),
        meta: {}
    },
    {
        path: '/book/categoryDetail/:gender/:major',
        name: 'bookcatDetail',
        component: require('./components/category/BookcatDetail'),
        meta: {}
    },
    //测试操作
    {
        path: '/profile',
        name: 'profile',
        component: require('./components/user/profile'),
        meta: {requireAuth: true}
    },
]
const router = new VueRouter({
    mode: 'history',
    routes
})

//路由过滤
router.beforeEach((to,from,next)=>{
    if (to.meta.requireAuth) {
        if (Store.state.AuthUser.authenticated || JWT.getToken()) {
            return next()
        }else {
            return next({'name':'login'})
        }
    }
    if (to.meta.requireGuest) {
        if (Store.state.AuthUser.authenticated || JWT.getToken()) {
            return next({'name': 'home'})
        }else {
            return next()
        }
    }
    next()
})

export default  router