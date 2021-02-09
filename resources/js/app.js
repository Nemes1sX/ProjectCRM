require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'
import 'fullcalendar/dist/fullcalendar.css';
import FullCalendar from 'vue-full-calendar';
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
import VueAxios from 'vue-axios'
import axios from 'axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './components/App.vue'
import router from './routes/index'
import auth from './auth'



import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = Vue;

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.router = router;
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(FullCalendar);
Vue.use(require('@websanova/vue-auth'), auth);

const app = new Vue({
    el: '#app',
    components: { App },
    router
})
