import VueRouter from 'vue-router'
import Store from './store'
import JWT from './helpers/jwt'
let routes = [
    {
        path: '/',
        name: 'home',
        component: require('./components/user/Profile'),//profile暂时作为主页
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
        path: '/questions/create',
        name: 'questionCreate',
        component: require('./components/question/Create'),
        meta: {requireAuth: true}
    },
    {
        path: '/questions/:id/edit',
        name: 'questionEdit',
        component: require('./components/question/Edit'),
        meta: {requireAuth: true}
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
    {
        path: '/profile',
        component: require('./components/user/ProfileWrapper'),
        children: [
            {
                path: '',
                name: 'profile',
                component: require('./components/user/Profile'),
                meta: {requireAuth: true}
            },
        ],
        meta: {requireAuth: true}
    },
    {
        path: '/bookcat/detail',
        name: 'bookcatDetail',
        component: require('./components/category/BookcatDetail')
    },
    {
        path: '/readbook/:bookId',
        name: 'readbook',
        component: require('./components/book/ReadBook')
    },
    {
        path: '/book/:bookId',
        name: 'book',
        component: require('./components/common/Book')
    },
    {
        path: '/changeSource/:bookId',
        name: 'changeSource',
        component: require('./components/book/ChangeSource')
    },
    // {
    //     path: '/ranklist',
    //     name: 'ranklist',
    //     redirect: '/ranklist/weekRank',
    //     component: Ranklist,
    //     children: [
    //         {
    //             path: '/ranklist/*',
    //             name: 'RanklistDetail',
    //             component: RanklistDetail
    //         }
    //     ]
    // }
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
