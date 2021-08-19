import PostAPI from "../../api/post.js";

export const posts = {
    state: {
        posts: {},
        post: []
    },

    getters: {
        posts: state => state.posts,
        post: state => state.post
    },

    actions: {
        async LoadPostPublic({ commit }) {
            await PostAPI.LoadPostPublic().then((response) => {
                commit('SET_POSTS', response.data.data);
            }).catch(function () {
                commit('SET_POSTS', {});
            });
        },
        LoadPosts({ commit }) {
            PostAPI.LoadPosts().then((response) => {
                commit('SET_POSTS', response.data.data);
            }).catch(function () {
                commit('SET_POSTS', {});
            });
        },
        
        async AddNewPost({ commit }, data) {
            return await PostAPI.AddNewPost(data).then((response) => {
                commit('ADD_NEW_POST', response.data.data);
                return response.data.message;
            }).catch(function () {
                commit('ADD_NEW_POST', {});
            });
        },

        FindPost({ commit }, id) {
            PostAPI.FindPost(id).then((response) => {
                commit('SET_POST', response.data.data);
            }).catch(function () {
                commit('SET_POST', []);
            });
        },

        UpdatePost({ commit, state, dispatch }, data) {
            PostAPI.UpdatePost(data).then((response) => {
                commit('SET_POSTS', response.data.data);
                dispatch('LoadPosts')
            }).catch(function () {
                commit('SET_POSTS', {});
            });
        },

        RemovePost({ commit, state, dispatch }, id) {
            PostAPI.DeletePost(id).then((response) => {
                console.log(response.data.data)
                commit('REMOVE_POST', response.data.data);
                dispatch('LoadPosts')
            }).catch(function () {
                commit('REMOVE_POST', {});
            });
        },
    },

    mutations: {

        SET_POSTS(state, post) {
            state.posts = post;
        },
        SET_POST(state, post) {
            state.post = post;
        },

        FETCH_POSTS: (state, posts) => state.posts = posts,
        ADD_NEW_POST: (state, post) => state.posts.unshift(post),
        UPDATE_POST: (state, payload) => {
            state.posts = state.posts.map(blog => {
                if (blog.id === payload.id) {
                    return Object.assign({}, blog, payload.data)
                }
                return blog;
            });
        },
        REMOVE_POST: (state, id) => (
            state.posts.filter(post => post.id !== id),
            state.posts.splice(post => post.id, 1)
        )
    }
}
