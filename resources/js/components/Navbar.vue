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
                    <li class="nav-item" style="color: white;" v-show="user">
                       <router-link class="nav-link" to="/settings" >
                        Settings
                       </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>
                    <li class="nav-item" v-show="!user">
                        <router-link class="nav-link" to="/login">Login</router-link>
                    </li>
                    <li class="nav-item" v-show="!user">
                        <router-link class="nav-link" to="/register">Register</router-link>
                    </li>
                    <li class="nav-item" v-show="user">
                        <a class="nav-link" href="#" @click="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

  export default {
    computed: {
        ...mapGetters("auth", ["user"])
    },
    mounted(){
        if (localStorage.getItem("authToken")) {
            this.getUserData();
        }
    },

    methods: {
        ...mapActions("auth", ["sendLogoutRequest", "getUserData"]),

        logout(){
            this.sendLogoutRequest();
            this.$router.push("/");
        }

    }

  }
</script>