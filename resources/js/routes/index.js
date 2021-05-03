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

const guest = (to, from, next) => {
    if (!localStorage.getItem("authToken")) {
        return next ();
    } else {
        return next("/");
    }
};
const auth  =  (to, from, next) => {
    if (localStorage.getItem("authToken")) {
        return next();
    } else {
        return next("/login");
    }
};

const routes =  [
        {
            path: '/register',
            name: 'register',
            beforeEnter: guest,
            component: Register,
        },
        {
            path: '/login',
            name: 'login',
            beforeEnter: guest,
            component: Login,
        },
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
            path: '/company',
            name:  'company',
            beforeEnter: auth,
            component: Companies,
        },
        {
            path: '/create',
            name: 'company.create',
            beforeEnter: auth,
            component: CreateCompany,
        },
        {
            path: '/company/edit',
            name: 'company.edit',
            beforeEnter: auth,
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
            beforeEnter: auth,
            component: Projects,
        },
        {
            path: '/projects/create',
            name: 'project.create',
            beforeEnter: auth,
            component: CreateProject,
        },
        {
            path: '/projects/edit',
            name: 'project.edit',
            beforeEnter: auth,
            component: CreateProject,
        },
        {
          path: '/taskboard/:id',
          name: 'task.board',
            beforeEnter: auth,
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
            beforeEnter: auth,
            component: Tasks,
        },
        {
            path: '/task/create',
            name: 'task.create',
            beforeEnter: auth,
            component: TaskAdd
        },

        {
            path: '/task/edit',
            name: 'task.edit',
            beforeEnter: auth,
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