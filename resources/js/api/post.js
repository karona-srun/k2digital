    
    /*
	Imports the Roast API URL from the config.
*/
import CONFIG from '../config.js';

export default {
    FetchPosts: function( )
    {
        return axios.get( CONFIG.setAPIURL() + '/fetch-posts');
    },
    LoadPostPublic: function( )
    {
        return axios.get( CONFIG.setAPIURL() + '/posts', { headers: CONFIG.responseHeaders() });
    },

    LoadPosts: function( )
    {
        return axios.get( CONFIG.setAPIURL() + '/posts/all', { headers: CONFIG.responseHeaders() });
    },

    AddNewPost: function( slug )
    {
        return axios.post( CONFIG.setAPIURL() + '/posts', slug, { headers: CONFIG.responseHeaders() } );
    },

    FindPost: function( id ){
        return axios.get( CONFIG.setAPIURL() + '/posts/' + id, { headers: CONFIG.responseHeaders() });
    },

    ToggleLike: function( slug ){
        return axios.post( CONFIG.setAPIURL() + '/togglelike', slug, { headers: CONFIG.responseHeaders() } );
    },

    UpdatePost: function( slug ){
        return axios.patch( CONFIG.setAPIURL() + '/posts/' + slug.id, slug, { headers: CONFIG.responseHeaders() });
    },

    DeletePost: function( id ){
		return axios.delete( CONFIG.setAPIURL() + '/posts/' + id, { headers: CONFIG.responseHeaders() } );
	},

	postLikePost: function( slug ){
		return axios.post( CONFIG.setAPIURL() + '/posts/' + slug + '/like',{ headers: CONFIG.responseHeaders() } );
	},

	deleteLikePost: function( slug ){
		return axios.delete( CONFIG.setAPIURL() + '/posts/' + slug + '/unlike', { headers: CONFIG.responseHeaders() } );
	}
}