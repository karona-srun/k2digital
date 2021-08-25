    
    /*
	Imports the Roast API URL from the config.
*/
import CONFIG  from '../config.js';
export default {

    FetchComments: function( )
    {
        return axios.get( CONFIG.setAPIURL() + '/fetch-comments');
    },

    FetchCommentByPost: function( id ){
        return axios.get( CONFIG.setAPIURL() + '/comment/find-comment-by-post/' + id);
    },

    LoadComments: function( )
    {
        return axios.get( CONFIG.setAPIURL() + '/comments', { headers: CONFIG.responseHeaders() });
    },

    AddNewComment: function( slug )
    {
        return axios.post( CONFIG.setAPIURL() + '/comments', slug, { headers: CONFIG.responseHeaders() });
    },

    FindCommentByPost: function( id ){
        return axios.get( CONFIG.setAPIURL() + '/comments/find-comment-by-post/' + id, { headers: CONFIG.responseHeaders() });
    },

    FindComment: function( id ){
        return axios.get( CONFIG.setAPIURL() + '/comments/' + id, { headers: CONFIG.responseHeaders() });
    },

    UpdateComment: function( slug ){
        return axios.patch( CONFIG.setAPIURL() + '/comments/' + slug.id, slug, { headers: CONFIG.responseHeaders() });
    },

    DeleteComment: function( id ){
		return axios.delete( CONFIG.setAPIURL() + '/comments/' + id , { headers: CONFIG.responseHeaders() });
	}
}