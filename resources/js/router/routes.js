function page(path) {
    return () => import(/* webpackChunkName: '' */ `../pages/${path}`).then(
        m => m.default || m)
}

export default [
    {
        path: '/',
        component:  page('auth/Login'),
        props: true
        // beforeEnter: (to, from, next) => {
        //     let token = localStorage.getItem("token");
        //     if (typeof token!=='undefined' && token){
        //         return next({
        //             name: 'userDashboard'
        //         })
        //
        //     }
        //     return next()
        // },

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
