import CONFIG  from '../config.js';

export default {
    Index: function( data )
    {
        return axios.get( CONFIG.setAPIURL() + '/tiktok', data);
    },
    SubmitLink: function( data )
    {
        return axios.post( CONFIG.setAPIURL() + '/tiktok/submit', data);
    },
}