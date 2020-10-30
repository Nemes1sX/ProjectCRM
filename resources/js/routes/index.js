import Homepage from '../pages/Homepage.vue'
import About from '../pages/About.vue'
import Contact from '../pages/Contact.vue'
import Companies from '../pages/Companies.vue'
import Projects from '../pages/Projects.vue'

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Homepage,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
        },
        {
            path: '/companies',
            name: 'companies',
            component: Companies,
        },
        {
            path: '/projects',
            name: 'projects',
            component: Projects,
        },
    ]
}
