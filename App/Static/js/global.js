

/* axios.defaults.baseURL = 'https://api.example.com';
axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'; */
//实例化请求
const Http = axios.create({
    baseURL: '',
    timeout: 1000,
    headers: {
        'X-Author': 'pingo',
       // 'Content-type': 'multipart/form-data'
    },
    method: 'get', //default
    // `transformRequest` allows changes to the request data before it is sent to the server
  // This is only applicable for request methods 'PUT', 'POST', 'PATCH' and 'DELETE'
  // The last function in the array must return a string or an instance of Buffer, ArrayBuffer,
    /* transformRequest: [function (data, headers) {
        // Do whatever you want to transform the data
        return data;
      }], */
    // `transformResponse` allows changes to the response data to be made before
    // it is passed to then/catch
    transformResponse: [function (data) {
        // Do whatever you want to transform the data

        return data;
    }],
    //`params` are the URL parameters to be sent with the request
    // Must be a plain object or a URLSearchParams object
    params: {
       
    },
    // `data` is the data to be sent as the request body
  // Only applicable for request methods 'PUT', 'POST', 'DELETE , and 'PATCH'
  // When no `transformRequest` is set, must be of one of the following types:
  // - string, plain object, ArrayBuffer, ArrayBufferView, URLSearchParams
  // - Browser only: FormData, File, Blob
  // - Node only: Stream, Buffer
    data: {
         
      },
    // `withCredentials` indicates whether or not cross-site Access-Control requests
    // should be made using credentials
    withCredentials: false, // default
    responseType: 'json', // default
     // `auth` indicates that HTTP Basic auth should be used, and supplies credentials.
    // This will set an `Authorization` header, overwriting any existing
    // `Authorization` custom headers you have set using `headers`.
    // Please note that only HTTP Basic auth is configurable through this parameter.
    // For Bearer tokens and such, use `Authorization` custom headers instead.
    auth: {
        
    },
    // `xsrfCookieName` is the name of the cookie to use as a value for xsrf token
    xsrfCookieName: 'XSRF-TOKEN', // default

    // `xsrfHeaderName` is the name of the http header that carries the xsrf token value
    xsrfHeaderName: 'X-XSRF-TOKEN', // default

    // `onUploadProgress` allows handling of progress events for uploads
    // browser only
    onUploadProgress: function (progressEvent) {
        // Do whatever you want with the native progress event
    },

    // `onDownloadProgress` allows handling of progress events for downloads
    // browser only
    onDownloadProgress: function (progressEvent) {
        // Do whatever you want with the native progress event
    },
    // `validateStatus` defines whether to resolve or reject the promise for a given
    // HTTP response status code. If `validateStatus` returns `true` (or is set to `null`
    // or `undefined`), the promise will be resolved; otherwise, the promise will be
    // rejected.
    validateStatus: function (status) {
         
        return status >= 200 && status < 300; // default
    } 
  });

  // Send a POST request
 

 // Add a request interceptor
Http.interceptors.request.use(function (config) {
    // Do something before request is sent
    return config;
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
  });

// Add a response interceptor
Http.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
  }, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return Promise.reject(error);
  });


function http_post(url, datajson, callback)
{
    if(typeof datajson === 'object'){
          let tmpdata = ""
           for (const key in datajson) {
            tmpdata += key + "=" + datajson[key] + "&"
           }
           datajson = tmpdata.substring(0, tmpdata.length - 1)
    }
    Http.post(url, datajson).then(result => {
        callback(result.data)
    }).catch(function(error){
        console.log(error)
        layer.msg("请求出错！！")
    })
    
}

function http_get(url, callback)
{
    Http.get(url).then(result => {
        callback(result.data)
    }).catch(function(error){
        console.log(error)
        layer.msg("请求出错！！")
    })
    
}