    
    /*
	Imports the Roast API URL from the config.
*/
import { ROAST_CONFIG } from '../config.js';

export default {
    LoadPostPublic: function( )
    {
        return axios.get( ROAST_CONFIG.API_URL + '/posts');
    },

    LoadPosts: function( )
    {
        return axios.get( ROAST_CONFIG.API_URL + '/posts/all');
    },

    AddNewPost: function( slug )
    {
        return axios.post( ROAST_CONFIG.API_URL + '/posts', slug );
    },

    FindPost: function( id ){
        return axios.get( ROAST_CONFIG.API_URL + '/posts/' + id);
    },

    UpdatePost: function( slug ){
        return axios.patch( ROAST_CONFIG.API_URL + '/posts/' + slug.id, slug);
    },

    DeletePost: function( id ){
		return axios.delete( ROAST_CONFIG.API_URL + '/posts/' + id );
	},

	postLikePost: function( slug ){
		return axios.post( ROAST_CONFIG.API_URL + '/posts/' + slug + '/like' );
	},

	deleteLikePost: function( slug ){
		return axios.delete( ROAST_CONFIG.API_URL + '/posts/' + slug + '/unlike' );
	}
}