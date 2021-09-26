import CONFIG from '../config.js';

export default {
    FetchGroupList: function( slug )
    {
        return axios.post( CONFIG.setAPIURL() + '/facebook/get-facebook-groups',slug);
    },

    FetchFacebookKeywords: function( slug )
    {
        return axios.post( CONFIG.setAPIURL() + '/facebook/get-facebook-keywords',slug);
    },

    SubmitAccessToken: function( accessToken )
    {
        return axios.post( CONFIG.setAPIURL() + '/facebook/submit-access-token',accessToken, { headers: CONFIG.responseHeaders() });   
    },

    DeleteAccessToken: function( id ) 
    {
        return axios.delete( CONFIG.setAPIURL() + '/facebook/delete-facebook-token/'+id, { headers: CONFIG.responseHeaders() });  
    }
}