import CommentAPI from "../../api/comment.js";

export const comments = {
    state: {
        comments: [],
        comment: {}
    },

    getters: {
        comments: state => state.comments,
        comment: state => state.comment
    },

    actions: {
        async LoadComments({ commit }) {
            return await CommentAPI.FetchComments().then((response) => {
                commit('SET_COMMENTS', response.data.data);
                return response.data.data
            }).catch(function () {
                commit('SET_COMMENTS', {});
            });
        },
        
        async AddNewComment({ commit }, data) {
            console.log('data: ' + data);
            return await CommentAPI.AddNewComment(data).then((response) => {
                commit('ADD_NEW_COMMENTS', response.data.data);
                return response.data.message;
            }).catch(function () {
                commit('ADD_NEW_COMMENTS', {});
            });
        },

        FetchCommentByPost({ commit }, id) {
            CommentAPI.FetchCommentByPost(id).then((response) => {
                commit('SET_COMMENTS', response.data.data);
            }).catch(function () {
                commit('SET_COMMENTS', {});
            });
        },

        FindCommentByPost({ commit }, id) {
            CommentAPI.FindCommentByPost(id).then((response) => {
                commit('SET_COMMENTS', response.data.data);
            }).catch(function () {
                commit('SET_COMMENTS', {});
            });
        },

        FindComment({ commit }, id) {
            CommentAPI.FindComment(id).then((response) => {
                commit('SET_COMMENTS', response.data.data);
            }).catch(function () {
                commit('SET_COMMENTS', {});
            });
        },

        UpdateComment({ commit, state, dispatch }, data) {
            CommentAPI.UpdateComment(data).then((response) => {
                commit('SET_COMMENTS', response.data.data);
                dispatch('LoadComments')
            }).catch(function () {
                commit('SET_COMMENTS', {});
            });
        },

        RemoveComment({ commit, state, dispatch }, id) {
            return CommentAPI.DeleteComment(id).then((response) => {
                commit('REMOVE_COMMENT', response.data.data);
                dispatch('LoadComments')
                return response.data;
            }).catch(function () {
                commit('REMOVE_COMMENT', {});
            });
        },
    },

    mutations: {

        SET_COMMENTS(state, comment) {
            state.comments = comment;
        },

        FETCH_COMMENTS: (state, comments) => state.comments = comments,
        ADD_NEW_COMMENTS: (state, comment) => state.comments.push(comment),
        UPDATE_COMMENT: (state, payload) => {
            state.comments = state.comments.map(blog => {
                if (blog.id === payload.id) {
                    return Object.assign({}, blog, payload.data)
                }
                return blog;
            });
        },
        REMOVE_COMMENT: (state, id) => (
            state.comments.filter(comment => comment.id !== id),
            state.comments.splice(comment => comment.id, 1)
        )
    }
}
