export default [
    {
        path: '/',
        component: () => import('@/pages/general/Main.vue'),
        name: 'main',
        redirect: {
            name: 'home'
        },
        children: [
            {
                path: '/home',
                component: () => import('@/pages/general/Home.vue'),
                name: 'home',
            },
            {
                path: '/car-rides',
                component: () => import('@/pages/general/CarRides.vue'),
                name: 'car-rides',
            },
            {
                path: '/transports',
                component: () => import('@/pages/general/Transports.vue'),
                name: 'transports',
            },
        ]
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

