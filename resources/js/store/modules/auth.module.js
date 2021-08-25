import Auth from "../../api/auth.js";

export const auth = {
    state: {
        auth: null,
        access_token: null
    },

    getters: {
        auth: state => state.auth,
        access_token: state => state.access_token,
        isAuthenticated: state => !!state.access_token,
    },

    actions: {
        async SignIn({ commit }, data ) {
            return await Auth.SignIn(data).then((response) => {
                localStorage.setItem("accessToken",JSON.stringify(response.data.access_token))
                commit('SET_TOKEN', response.data.access_token);
                return response.data.status
            }).catch(function (error) {
                let token = null
                commit('SIGN_OUT', token)
                return error.data.message
            });
        },

        async SignUp({ commit }, data ) {
            return await Auth.SignUp(data).then((response) => {
                return response.data.status
                // commit('SET_SIGNIN', response.data.data);
            }).catch(function (error) {
                let token = null
                commit('SIGN_OUT', token)
                return error.data.message
            });
        },

        async Me({ commit }){
            await Auth.Me().then((response) => {
                localStorage.setItem("authID",response.data.data.id)
                localStorage.setItem("authEmail",response.data.data.id)
                localStorage.setItem("authName",response.data.data.first_name +' '+response.data.data.last_name)
                commit('AUTH', response.data.data);
            }).catch( error => {
                let token = null
                commit('AUTH', token)
            });
        },

        async SignOut({commit}){
            let token = null
            localStorage.removeItem("accessToken");
            localStorage.removeItem("authID");
            localStorage.removeItem("authEmail");
            localStorage.removeItem("authName");
            await commit('SIGN_OUT', token)
        } 
    },

    mutations: {
        SET_TOKEN(state, token) {
            state.access_token = token;
        },
        SIGN_OUT(state){
            state.access_token = null,
            state.auth = null
        },
        AUTH(state,auth){
            state.auth = auth
        },
    }
}
