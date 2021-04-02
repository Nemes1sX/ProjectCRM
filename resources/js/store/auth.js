import axios from "axios";

export default {
    namespaced: true,

    state: {
        userData: null
    },

    getters: {
        user: state => state.userData
    },

    mutations: {
        setUserData(state, user){
            state.userData = user;
        }
    },

    actions: {
        gerUserData({ commit }){
            axios
                .get(`${process.env.MIX_APP_URL}/api/auth/` + 'user')
                .then(response => {
                    commit("setUserData", response.data)
                })
                .catch(() =>{
                    localStorage.removeItem('authToken');
                })
        },
        sendLoginRequest({commit}, data) {
            commit('setErrors', {}, {root: true});
            return axios
                .post(`${process.env.MIX_APP_URL}/api/auth/`+ 'login', data)
                .then(response => {
                    commit('setUserData', response.data.user);
                    localStorage.setItem("authToken", response.data.token)
                });
        },
        sendRegisterRequest({ commit }, data) {
            commit("setErrors", {}, {root: true});
            return axios
                .post(`${process.env.MIX_APP_URL}/api/auth/` + 'register', data)
                .then(response => {
                   commit("setUserData", response.data.user)
                    localStorage.setItem('authToken', response.data.token);
                });
        },
        sendLogoutRequest({commit}) {
            axios.post(`${process.env.MIX_APP_URL}/api/auth/` + 'logout').then(() => {
               commit('setUserData', null);
               localStorage.removeItem('authToken');
            });
        },
    }
}

