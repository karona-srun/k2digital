import Auth from "../../api/auth.js";
import PETools from "../../api/petools";

export const auth = {
    state: {
        auth: null,
        access_token: null,
        auth_petools: null,
        has_petools: null,
        facebook_access_token: null
    },

    getters: {
        auth: state => state.auth,
        access_token: state => state.access_token,
        isAuthenticated: state => !!state.access_token,
        facebook_access_token: state => state.facebook_access_token,
        isAuthenticatedFacebook: state => !!state.facebook_access_token,
        hasPetools: state => !!state.has_petools
    },

    actions: {
        // AUTH
        async SignIn({ commit,state,dispatch }, data ) {
            return await Auth.SignIn(data).then((response) => {
                localStorage.setItem("accessToken",JSON.stringify(response.data.access_token))
                commit('SET_TOKEN', response.data.access_token);
                dispatch('Me');
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
                if(response.data.data.has_petools){
                    commit('AUTH_PETOOLS', response.data.data.petools);
                    commit('HAS_PETOOLS', response.data.data.has_petools);
                }
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
        },

        // PE TOOLS 'POWER EDITOR TOOLS'
        async SubmitAccessToken({ commit }, slug){
            return await PETools.SubmitAccessToken(slug).then((response) => {
                if(response.data.status == "success" || response.data.mode == "1"){
                    commit('ACCESS_TOKEN', response.data.data.fb_access_token);
                }else
                    commit('ACCESS_TOKEN','');
                return response.data
            }).catch(function () {
                commit('ACCESS_TOKEN', '');
            });
        },

        async FetchGroupList({ commit }, slug) {
            return await PETools.FetchGroupList(slug).then((response) => {
                if(response.data.status == "success"){
                    commit('FETCH_GROUP_LIST', response.data.data.data);
                }
                commit('FETCH_GROUP_LIST','');
                return response.data
            }).catch(function () {
                commit('FETCH_GROUP_LIST', {});
            });
        },

        async SignOutPE({ commit }){
            await commit('ACCESS_TOKEN','');
        },

        async DeleteAccessToken({ commit, state, dispatch}, id)
        {
            return await PETools.DeleteAccessToken(id).then((response) => {
                if(response.data.status == "success"){
                    commit('ACCESS_TOKEN', '');
                    dispatch('Me')
                }
                return response.data
            }).catch(function () {
                commit('ACCESS_TOKEN', '');
            });
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
        AUTH_PETOOLS(state, payload){
            state.auth_petools = payload
        },
        HAS_PETOOLS(state, payload){
            state.has_petools = payload
        },
        ACCESS_TOKEN(state, payload){
            state.facebook_access_token = payload
        }
    }
}
