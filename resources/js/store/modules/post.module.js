import PostAPI from "../../api/post.js";

export const posts = {
    state: {
        posts: {},
        post: {}
    },

    getters: {
        posts: state => state.posts,
        post: state => state.post
    },

    actions: {
        async LoadPostPublic({ commit }) {
            await PostAPI.FetchPosts().then((response) => {
                commit('SET_POSTS', response.data.data);
            }).catch(function () {
                commit('SET_POSTS', {});
            });
        },
        async LoadPosts({ commit }) {
            await PostAPI.LoadPosts().then((response) => {
                commit('SET_POSTS', response.data.data);
            }).catch(function () {
                commit('SET_POSTS', {});
            });
        },
        
        async AddNewPost({ commit,state, dispatch }, data) {
            return await PostAPI.AddNewPost(data).then((response) => {
                dispatch('LoadPosts')
                commit('ADD_NEW_POST', response.data.data);
                return response.data.status;
            }).catch(function () {
                commit('ADD_NEW_POST', {});
            });
        },

        ToggleLike({ commit }, data){
            PostAPI.ToggleLike(data).then((response) => {
                console.log(response.data.data)
            }).catch(function () {
                commit('SET_POST', []);
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
                commit('UPDATE_POST', response.data.data);
                dispatch('LoadPosts')
            }).catch(function () {
                commit('SET_POSTS', {});
            });
        },

        RemovePost({ commit, state, dispatch }, id) {
            PostAPI.DeletePost(id).then((response) => {
                commit('REMOVE_POST', response.data.data);
                dispatch('LoadPosts')
            }).catch(function () {
                commit('REMOVE_POST', {});
            });
        },
    },

    mutations: {

        SET_POSTS(state, posts) {
            state.posts = posts;
        },
        SET_POST(state, post) {
            state.post = post;
        },

        FETCH_POSTS: (state, posts) => state.posts = posts,
        ADD_NEW_POST (state, post) {
            state.post = Object.assign({}, post)
          },
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
