import Vue from 'vue'
import App from './App'

import VueSession from 'vue-session'

import router from './router'

import moment from 'moment'
import 'bootstrap'

Vue.config.productionTip = false
Vue.use(VueSession)

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    render: h => h(App),
})

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).startOf('hour').fromNow()
        // return moment(String(value)).startOf('day').fromNow()
        // return moment(String(value)).format('MM/DD/YYYY HH:mm:ss')
    }
})

Vue.filter('harvestDate', function (value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY')
    }
})