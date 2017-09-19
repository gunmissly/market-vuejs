import Vue from 'vue'
import Router from 'vue-router'
import Profile from '@/components/Profile'
import Login from '@/components/Login'
const Create = () =>
    import ('@/view/product/Create')
const Market = () =>
    import ('@/components/Market')
const Map = () =>
    import ('@/components/product/Map')

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
        },
        {
            path: '/map',
            name: 'Map',
            component: Map,
        }
    ],
    mode: 'history',
    linkExactActiveClass: 'active',
});