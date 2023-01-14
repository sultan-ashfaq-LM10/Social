export default {
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        /* Main website routes */
        // {
        //     path: '*',
        //     component: () => import('./components/Errors/404'),
        // },
        {
            path: '/',
            component: () => import('../components/App.vue'),
            name: 'App',
            meta: { requiresAuth: false },
            children: [
              {
                path: '/search',
                component: () => import('../components/Search/SearchIndex.vue'),
                name: 'Search',
                meta: { requiresAuth: false },
              },
                {
                    path: '/home',
                    component: () => import('../components/HomeFeed/HomeFeedIndex.vue'),
                    name: 'HomeFeed',
                    meta: { requiresAuth: false },
                },
                {
                    path: '/profile',
                    component: () => import('../components/Profile/ProfileIndex.vue'),
                    name: 'Profile',
                    meta: { requiresAuth: false },
                },
            ]
        },

    ],
}
