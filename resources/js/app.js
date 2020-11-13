require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
import routes from './routes'
import VueAxios from 'vue-axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'fullcalendar/dist/fullcalendar.css';
import FullCalendar from 'vue-full-calendar';
import App from './components/App.vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)


Vue.use(FullCalendar);

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
})
