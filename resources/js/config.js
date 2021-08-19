/*
	Defines the API route we are using.
*/
var api_url = '';

/*
  Depending on the environment, define the API URL.
*/
switch( process.env.NODE_ENV ){
  case 'development':
    api_url = 'http://k2digital.test/api';
  break;
  case 'production':
    api_url = 'http://k2digital.com/api';
  break;
}

/*
  Export the roast URL configuration.
*/
export const ROAST_CONFIG = {
  API_URL: api_url,
}