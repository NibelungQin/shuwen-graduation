import VueRouter from 'vue-router'
import Store from './store'
import JWT from './helpers/jwt'
let routes = [
    {
        path: '/',
        name: 'home',
        component: require('./components/index/Index'),
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
        path: '/users',
        component: require('./components/user/Users'),
        children: [
            {
                path: ':name',
                meta: {
                    title: ':name 个人信息 | 书问'
                },
                name: 'user_replies',
                component: require('./components/user/Replies'),
            },
            {
                path: ':name/following',
                meta: {
                    title: ':name 关注信息 | 书问'
                },
                name: 'user_following',
                component: require('./components/user/Following'),
            },
        ]
    },
    {
        path: '/users',
        component: require('./components/user/SideBar'),
        meta: {requireAuth: true},
        children: [
            {
                path: ':name/edit',
                name: 'user_edit',
                component: require('./components/user/Profile'),
                meta: {
                    title: '编辑个人资料 | 书问',
                    requireAuth: true
                },
            },
            {
                path: ':name/edit_avatar',
                name: 'user_edit_avatar',
                component: require('./components/user/Avatar'),
                meta: {
                    title: '编辑头像 | 书问',
                    requireAuth: true
                },
            },
            {
                path: ':name/edit_password',
                name: 'user_edit_password',
                component: require('./components/user/Password'),
                meta: {
                    title: '修改密码 | 书问',
                    requireAuth: true
                },
            },
        ]
    },
    {
        path: '/questions',
        name: 'questions',
        component: require('./components/question/Index'),
        meta: {}
    },
    {
        path: '/questions/create',
        name: 'questionCreate',
        component: require('./components/question/Create'),
        meta: {requireAuth: true}
    },
    {
        path: '/questions/:id',
        name: 'questionShow',
        component: require('./components/question/Show'),
        meta: {}
    },
    {
        path: '/questions/:id/edit',
        name: 'questionEdit',
        component: require('./components/question/Edit'),
        meta: {requireAuth: true}
    },
    {
        path: '/questions/:id/answer',
        name: 'answerCreate',
        component: require('./components/answer/Create'),
        meta: {}
    },
    {
        path: '/articles',
        name: 'articles',
        component: require('./components/articles/Index'),
        meta: {}
    },
    {
        path: '/articles/create',
        name: 'article_create',
        component: require('./components/articles/Create'),
        meta: {requireAuth: true}
    },
    {
        path: '/articles/:id',
        name: 'article_show',
        component: require('./components/articles/Show'),
        meta: {}
    },
    {
        path: '/articles/:id/edit',
        name: 'article_edit',
        component: require('./components/articles/Edit'),
        meta: {requireAuth: true}
    },

    {
        path: '/comment',
        component: require('./components/comment/CommentReply'),
    },

    {
        path: '/notifications',
        name: 'notifications',
        component: require('./components/notification/Index'),
        meta: {requireAuth: true}
    },
    {
        path: '/inbox',
        name: 'inbox',
        component: require('./components/inbox/Index'),
        meta: {requireAuth: true}
    },
    {
        path: '/inbox/:id',
        name: 'inboxShow',
        component: require('./components/inbox/Show'),
        meta: {requireAuth: true}
    },
    {
        path: '/book/category',
        name: 'bookCategory',
        component: require('./components/book/BookCategory'),
        meta: {}
    },
    {
        path: '/book/categoryDetail/:gender/:major',
        name: 'bookcatDetail',
        component: require('./components/book/BookcatDetail'),
        meta: {}
    },
    {
        path: '/bookcat/detail',
        name: 'bookcatDetail',
        component: require('./components/book/BookcatDetail')
    },
    {
        path: '/readbook/:bookId',
        name: 'readbook',
        component: require('./components/book/ReadBook')
    },
    {
        path: '/book/:bookId',
        name: 'book',
        component: require('./components/book/Book')
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

    {
        path:'/chat',
        name: 'chat',
        component: require('./components/chat/Chat'),
        meta: {requireAuth: true}
    },
    {
        path:'/chat/item',
        name: 'chatItem',
        component: require('./components/chat/ChatItem'),
        meta: {requireAuth: true}
    },
    {
        path:'/chat/area',
        name: 'chatArea',
        component: require('./components/chat/ChatArea'),
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
