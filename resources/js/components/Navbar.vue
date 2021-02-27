<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <router-link :to="{ name: 'home' }"
                         class="navbar-brand">Project</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" style="color: white;">Settings</li>
                    <li v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                        <router-link  :to="{ name : route.path }" :key="key">
                            {{route.name}}
                        </router-link>
                    </li>
                    <!--LOGOUT-->
                    <li v-if="$auth.check()">
                        <a href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data(){
            return {
                routes: {
                    // UNLOGGED
                    unlogged: [
                        {
                            name: 'Login',
                            path: 'login'
                        }
                    ],

                }
            }
        },
        mounted(){

        },

    }
</script>