    
    /*
	Imports the Roast API URL from the config.
*/
import { ROAST_CONFIG } from '../config.js';

export default {

    LoadComments: function( )
    {
        return axios.get( ROAST_CONFIG.API_URL + '/comments');
    },

    AddNewComment: function( slug )
    {
        return axios.post( ROAST_CONFIG.API_URL + '/comments', slug );
    },

    FindCommentByPost: function( id ){
        return axios.get( ROAST_CONFIG.API_URL + '/comments/find-comment-by-post/' + id);
    },

    FindComment: function( id ){
        return axios.get( ROAST_CONFIG.API_URL + '/comments/' + id);
    },

    UpdateComment: function( slug ){
        return axios.patch( ROAST_CONFIG.API_URL + '/comments/' + slug.id, slug);
    },

    DeleteComment: function( id ){
        console.log("api DeleteComment"+ id)
		return axios.delete( ROAST_CONFIG.API_URL + '/comments/' + id );
	}
}