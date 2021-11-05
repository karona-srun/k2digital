/*
	Defines the API route we are using.
*/
// var api_url = '';

/*
  Depending on the environment, define the API URL.
*/
// switch( process.env.NODE_ENV ){
//   case 'development':
//     api_url = 'http://k2digital.test/api';
//   break;
//   case 'production':
//     api_url = 'http://k2digital.com/api';
//   break;
// }

// const config = {
//   headers: {
//       "Access-Control-Allow-Origin": "*",
//       "Content-Type": "application/x-www-form-urlencoded; application/json; charset=UTF-8",
//       "Accept": "application/json",
//       "Authorization": "Bearer "
//   }
// }


/*
  Export the roast URL configuration.
*/
// export const ROAST_CONFIG = {
//   API_URL: api_url
// }


class CONFIG {
  
  setAPIURL() {
    // if( process.env.NODE_ENV == 'development' ){
    //   return 'http://k2digital.test/api';
    // }else if( process.env.NODE_ENV == 'production'){
      return 'https://k2digital.karonasrun.com/api';
    // }
  }

  responseHeaders() {
      let token = JSON.parse(localStorage.getItem("accessToken"));
      if (token) {
          let header = {
              "Access-Control-Allow-Origin": "*",
              "Content-Type": "application/x-www-form-urlencoded; multipart/form-data; application/json; charset=UTF-8",
              "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest",
              "Authorization": `Bearer ${token}`
          };
          return header;
      } else {
          return {};
      }
  }

  responseHeadersMultipart() {
    let token = JSON.parse(localStorage.getItem("accessToken"));
    if (token) {
        let header = {
            "Access-Control-Allow-Origin": "*",
            "Content-Type": "application/x-www-form-urlencoded; multipart/form-data; application/json; charset=UTF-8",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "Authorization": `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
        };
        return header;
    } else {
        return {};
    }
}
};

export default new CONFIG();