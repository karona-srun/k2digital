import Tiktok from "../../api/tiktok.js";

export const tiktok = {
    state: {
        videos: {}
    },

    getters: {
        videos: state => state.videos
    },

    actions: {
        async Index({ commit }, data ) {
            return await Tiktok.Index(data).then((response) => {
                console.log( JSON.stringify( response.data.data ))
                return JSON.stringify(response.data.data)
            }).catch(function (error) {
                return error
            });
        },
        async SubmitLink ({ commit }, data ) {
            await Tiktok.SubmitLink(data).then((response) => {
                console.log( JSON.stringify( response ))
            }).catch(function (error) {
                console.log( JSON.stringify(  error ));
            });
        },
    },

    mutations: {

    }
}