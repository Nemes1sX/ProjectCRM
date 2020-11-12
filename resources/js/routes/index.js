import Homepage from '../pages/Homepage.vue'
import About from '../pages/About.vue'
import Contact from '../pages/Contact.vue'
import Companies from '../pages/Companies.vue'
import CreateCompany from '../pages/CreateCompany.vue'
import Projects from '../pages/Projects.vue'
import CreateProject from '../pages/CreateProject.vue'
import Tasks from '../pages/Tasks.vue'
import TaskAdd from '../pages/TaskAdd.vue'

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
            path: '/company/create',
            name: 'company.create',
            component: CreateCompany,
        },
        {
            path: '/company/edit',
            name: 'company.edit',
            component: CreateCompany,
        },
        {
            path: '/projects',
            name: 'projects',
            component: Projects,
        },
        {
            path: '/projects/create',
            name: 'project.create',
            component: CreateProject,
        },
        {
            path: '/projects/edit',
            name: 'project.edit',
            component: CreateProject,
        },
        {
            path: '/tasks',
            name: 'tasks',
            component: Tasks,
        },
        {
            path: '/task/create',
            name: 'task.create',
            component: TaskAdd
        },
        {
            path: '/task/edit',
            name: 'task.edit',
            component: TaskAdd,
        }
    ]
}
