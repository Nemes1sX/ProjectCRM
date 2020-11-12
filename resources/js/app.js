require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
import routes from './routes'
import VueAxios from 'vue-axios'
import App from './components/App.vue'

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
})
