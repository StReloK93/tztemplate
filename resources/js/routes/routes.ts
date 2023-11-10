export default [
    {
        path: '/',
        component: () => import('@/pages/general/Index.vue'),
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
                component: () => import('@/pages/general/CarRides/CarRides.vue'),
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
        path: '/register',
        name: 'register',
        meta: {
            guard: 'guest',
        },
        component: () => import('@/pages/Register.vue'),
    },
]

