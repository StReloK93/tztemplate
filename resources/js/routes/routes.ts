const routes: any[] = [
  {
    path: '/',
    component: () => import('@/pages/general/Index.vue'),
    name: 'main',
    redirect: {
      name: 'car-rides',
    },
    meta: {
        guard: 'auth',
    },
    children: [
      {
        path: '/passengers',
        component: () => import('@/pages/general/Passengers/Passengers.vue'),
        name: 'passengers',
        meta: {
          title: "Yo'lovchilar",
        },
      },
      {
        path: '/car-rides',
        component: () => import('@/pages/general/CarRides/CarRides.vue'),
        name: 'car-rides',
        meta: {
          title: "Qatnovlar",
        },
      },
      {
        path: '/transports',
        component: () => import('@/pages/general/Transports/Transports.vue'),
        name: 'transports',
        meta: {
          title: "Transportlar",
        },
      },
    ],
  },
  {
    path: '/login',
    name: 'login',
    redirect: {
      name: 'login_page',
    },
    props: true,
    component: () => import('@/pages/login/Login.vue'),
    meta: {
      guard: 'guest',
    },
    children: [
      {
        name: 'login_page',
        path: '',
        component: () => import('@/pages/login/PhonePage.vue'),
      },
      {
        name: 'secret_code',
        path: '/secret-code',
        component: () => import('@/pages/login/SecretCode.vue'),
        props: true
      },
    ]
  },
  {
    path: '/register',
    name: 'register',
    meta: {
      guard: 'guest',
    },
    component: () => import('@/pages/Register.vue'),
  },
];

export default routes;