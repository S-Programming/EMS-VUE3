function page(path) {
    return () => import(/* webpackChunkName: '' */ `../pages/${path}`).then(
        m => m.default || m)
}

export default [
    {
        path: '/',
        name: 'login',
        component: page('auth/Login'),
        meta:{login: true, meta_title: 'User Login'},
        props: true,
        // beforeEnter: (to, from, next) => {
        //     let token = localStorage.getItem("accessToken");
        //     if (typeof token !== 'undefined' && token) {
        //         return next({
        //             name: 'userDashboard'
        //         })
        //
        //     }
        //     return next()
        // },
    },
    {
        name: 'userDashboard',
        path: '/v/dashboard',
        meta:{public:false,meta_title:'User Dashboard'},
        component: page('user/UserDashboard'),
        // beforeEnter: (to, from, next) => {
        //     let token = localStorage.getItem("accessToken");
        //     console.log(token)
        //     if (!token) {
        //         return next({
        //             name: 'login'
        //         })
        //     }
        //     return next()
        // }
    },
    // {
    //     path: '/login/:token?',
    //     name: 'login',
    //     meta: {login: true, meta_title: 'User Login'},
    //     component: page('auth/Login'),
    //     props: true
    // },
    {
        path: '/logout',
        name: 'logout',
        meta: {logout: true, meta_title: 'Logout'},
        component: page('auth/Logout')
    },
];
