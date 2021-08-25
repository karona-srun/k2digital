    
    /*
	Imports the Roast API URL from the config.
*/
import CONFIG  from '../config.js';

export default {
    SignIn: function( slug )
    {
        return axios.post( CONFIG.setAPIURL() + '/auth/sign-in', slug);
    },
    SignUp: function( slug )
    {
        const config = {
            headers: {
                "Access-Control-Allow-Origin": "*",
                "Content-Type": "application/x-www-form-urlencoded; application/json; charset=UTF-8",
                "Accept": "application/json",
            }
        }
        return axios.post( CONFIG.setAPIURL() + '/auth/sign-up', slug, config);
    },
    
    Me: function( )
    {        
        return axios.get( CONFIG.setAPIURL() + '/auth/me', { headers: CONFIG.responseHeaders() });
    },

    SignOut: function( )
    {
        return axios.post( CONFIG.setAPIURL() + '/auth/sign-out', { headers: CONFIG.responseHeaders() } );
    }
}