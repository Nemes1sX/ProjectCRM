import VueRouter from 'vue-router'


import Register from '../pages/auth/Register.vue'
import Login from '../pages/auth/Login.vue'
import Homepage from '../pages/Homepage.vue'
import About from '../pages/About.vue'
import Contact from '../pages/Contact.vue'
import Companies from '../pages/companies/Companies.vue'
import CreateCompany from '../pages/companies/CreateCompany.vue'
import Forbidden from '../pages/error/403.vue'
import NotExist from '../pages/error/404.vue'
import ShowComponent from '../pages/companies/ShowCompany.vue'
import Projects from '../pages/projects/Projects.vue'
import ProjectCalendar from '../pages/projects/ProjectCalendar.vue'
import CreateProject from '../pages/projects/CreateProject.vue'
import Tasks from '../pages/task/Tasks.vue'
import TaskBoard from '../pages/task/TaskBoard.vue'
import TaskAdd from '../pages/task/TaskAdd.vue'

const routes =  [
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/',
            name: 'home',
            component: Homepage,
            /*meta: {
                auth: undefined
            }*/
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
            path: '/company',
            name:  'company',
            component: Companies,
        },
        {
            path: '/create',
            name: 'company.create',
            component: CreateCompany,
        },
        {
            path: '/company/edit',
            name: 'company.edit',
            component: CreateCompany,

        },
        {
            path: '/company/show/:id',
            name: 'company.show',
            component: ShowComponent,
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
          path: '/taskboard/:id',
          name: 'task.board',
          component: TaskBoard,
            props: true,
        },
        {
          path: '/calendar',
          name: 'project.calendar',
          component: ProjectCalendar,
        },
        {
            path: '/tasks',
            name: 'tasks',
            component: Tasks,
           /* meta: {
                auth: true,
            }*/
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
        },
    {
        path: '/403',
        name: '403',
        component: Forbidden,
    },
    {
        path: '/404',
        name: '404',
        component: NotExist,
    }


]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})
export default router