<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <router-link :to="{ name: 'home' }"
                         class="navbar-brand">{{$t('app_name')}}</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" style="color: white;" v-show="user">
                       <router-link class="nav-link" to="/settings" >
                       {{$t('settings')}}
                       </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">{{$t('home')}}</router-link>
                    </li>
                    <li class="nav-item" v-show="!user">
                        <router-link class="nav-link" to="/login">{{$t('login')}}</router-link>
                    </li>
                    <li class="nav-item" v-show="!user">
                        <router-link class="nav-link" to="/register">{{$t('register')}}</router-link>
                    </li>
                    <li class="nav-item" v-show="user">
                        <a class="nav-link" href="#" @click="logout">{{$t('logout')}}</a>
                    </li>
                </ul>
                <select v-model="$i18n.locale">
                    <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">{{ lang }}</option>
                </select>
            </div>
        </div>
    </nav>
</template>

<script>

import {mapGetters, mapActions} from "vuex";

  export default {
      data() {
          return {
              langs: ['en', 'lt']
          }
      },
      computed: {
          ...mapGetters("auth", ["user"]),
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
      },


  }
</script>