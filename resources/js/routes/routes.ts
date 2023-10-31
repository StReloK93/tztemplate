export default [
    {
        path: '/',
        component: () => import('@/pages/Home.vue'),
        name: 'main',
    },
    {
        path: '/post/:id',
        component: () => import('@/pages/Post.vue'),
        props: true,
        name: 'post',
    },
    {
        path: '/login',
        name: 'login',
        meta: {
            guard: 'guest',
        },
        component: () => import('@/pages/Login.vue'),
    },
    {
        path: '/forgot-password',
        name: 'forgotpassword',
        meta: {
            guard: 'guest',
        },
        component: () => import('@/pages/ForgotPassword.vue'),
    },
    {
        path: '/register',
        name: 'register',
        meta: {
            guard: 'guest',
        },
        component: () => import('@/pages/Register.vue'),
    },
    {
        path: '/email/verify/:id/:hash',
        name: 'email-verify',
        props: true,
        component: () => import('@/pages/EmailVerify.vue'),
    },
]

