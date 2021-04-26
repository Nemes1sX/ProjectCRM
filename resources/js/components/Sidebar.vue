<template>
    <div>
        <b-button v-b-toggle.sidebar-1>{{$t('toggle_side')}}</b-button>
        <b-sidebar id="sidebar-1" title="Sidebar" shadow>
            <div class="px-3 py-2">
                <h1 class="my-4">Main menu</h1>
                <router-link active-class="active"
                             exact :to="{ name: 'home' }"
                             class="list-group-item">{{$t('home')}}</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'about' }"
                             class="list-group-item">{{$t('about')}}</router-link>

                <router-link active-class="active"
                             exact :to="{ name: 'contact' }"
                             class="list-group-item">{{$t('contact')}}</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'company' }"
                             class="list-group-item">{{$t('companies')}}</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'projects' }"
                             class="list-group-item">{{$t('projects')}}</router-link>
                <router-link active-class="active"
                             exact :to="{name: 'project.calendar'}"
                             class="list-group-item">{{$t('calendar')}}</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'tasks' }"
                             class="list-group-item">{{$t('tasks')}}</router-link>
            </div>
        </b-sidebar>
    <!-- /.col-lg-3 -->
    </div>
</template>
