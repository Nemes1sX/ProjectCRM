require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
import VueAxios from 'vue-axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './components/App.vue'
import router from './routes/index'


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = Vue

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.router = router
Vue.use(VueRouter)
Vue.use(VueAxios, axios)



const app = new Vue({
    el: '#app',
    components: { App },
    router
})
