<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Register user</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Validation errors.</p>
                    <p v-else>Error, unable to register at the moment. If the problem persists, please contact an administrator.</p>
                </div>
                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': errors.name }"
                                id="name"
                                v-model="details.name"
                                placeholder="Enter name"
                        />
                        <div class="invalid-feedback" v-if="errors.name">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input
                                type="email"
                                class="form-control"
                                :class="{ 'is-invalid': errors.email }"
                                id="email"
                                v-model="details.email"
                                placeholder="Enter email"
                        />
                        <div class="invalid-feedback" v-if="errors.email">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': errors.password }"
                                id="password"
                                v-model="details.password"
                                placeholder="Password"
                        />
                        <div class="invalid-feedback" v-if="errors.password">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input
                                type="password"
                                class="form-control"
                                id="password_confirmation"
                                v-model="details.password_confirmation"
                                placeholder="Confirm password"
                        />
                    </div>
                    <div class="form-group">
                        <label for="role">Choose role</label>
                        <select id="role" class="form-control" v-model="details.role">
                            <option value="Software engineer">Software engineer</option>
                            <option value="IT engineer">IT engineer</option>
                            <option value="Manager">Manager</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters, mapActions} from "vuex";

    export default {
        data() {
            return {
              details: {
                  name: '',
                  email: '',
                  password: '',
                  password_confirmation: '',
                  role: '',
              }
            };
        },
        computed: {
            ...mapGetters(["errors"])
        },
        mounted(){
            this.$store.commit("setErrors", {})
        },

        methods: {
            ...mapActions("auth", ["sendRegisterRequest"]),

            register() {
                this.sendRegisterRequest(this.details).then(() =>{
                    this.$router.push({name: 'home'})
                });
            }
            }
    }
</script>