<template>
    <div>
        <b-button v-b-toggle.sidebar-1>Toggle Sidebar</b-button>
        <b-sidebar id="sidebar-1" title="Sidebar" shadow>
            <div class="px-3 py-2">
                <h1 class="my-4">Main menu</h1>
                <router-link active-class="active"
                             exact :to="{ name: 'home' }"
                             class="list-group-item">Home</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'about' }"
                             class="list-group-item">About</router-link>

                <router-link active-class="active"
                             exact :to="{ name: 'contact' }"
                             class="list-group-item">Contact</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'companies' }"
                             class="list-group-item">Companies</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'projects' }"
                             class="list-group-item">Projects</router-link>
                <router-link active-class="active"
                             exact :to="{name: 'project.calendar'}"
                             class="list-group-item">Calendar</router-link>
                <router-link active-class="active"
                             exact :to="{ name: 'tasks' }"
                             class="list-group-item">Tasks</router-link>
            </div>
        </b-sidebar>
    <!-- /.col-lg-3 -->
    </div>
</template>
