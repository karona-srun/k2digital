import Vue from 'vue';
import Vuex from 'vuex';
import { auth } from './modules/auth.module';
import { posts } from './modules/post.module';
import { comments } from './modules/comment.module';
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    modules: {
        auth,
        posts,
        comments
    },
    plugins: [createPersistedState()],
});