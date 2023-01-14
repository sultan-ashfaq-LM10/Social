import './bootstrap';

import Vue from 'vue'
import routes from './routes'
import store from './store/store'
import VueRouter from 'vue-router'
import Buefy from 'buefy'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

Vue.use(VueRouter)
Vue.use(Buefy)
Vue.use(VueSweetalert2)

const router = new VueRouter(routes)
let app = new Vue({
    el: '#app',
    router: router,
    store
})
