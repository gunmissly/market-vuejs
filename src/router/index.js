import Vue from 'vue'
import Router from 'vue-router'
import Profile from '@/components/Profile'
import Create from '@/components/product/Create'
import Login from '@/components/Login'
const Market = () =>
    import ('@/components/Market')

Vue.use(Router)

export default new Router({
    routes: [{
            path: '/',
            name: 'Profile',
            component: Profile,
        },
        {
            path: '/market',
            name: 'Market',
            component: Market,
        },
        {
            path: '/create',
            name: 'Create',
            component: Create,
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
        }
    ],
    mode: 'history', 
    linkExactActiveClass: 'active',
});