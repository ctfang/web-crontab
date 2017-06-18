import VueCookie from 'vue-cookie';
var qs = require('qs');

global.VueCookie = VueCookie;


//------------- axios -----------
//
import axios from 'axios'

// 潜复制
let assign = (sup, sub) => {
    let obj = {};
    for (let k in sup) {
        obj[k] = sup[k];
    }
    for (let key in sub) {
        obj[key] = sub[key];
    }
    return obj;
}
global.http = {
    config: {
        baseURL: '/',
        timeout: 1000,
        // 跨域不能设置头
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },

    },
    get(url, config = {}) {
        config = assign(this.config, config);
        if (config.headers && config.headers.Authorization || config.headers.Authorization) {
            config.headers.HTTP_AUTHORIZATION = VueCookie.get('Authorization');
        }
        return axios.get(url, config);
    },
    post(url, data, config = {}) {
        config = assign(this.config, config);
        if (config.headers && config.headers.Authorization || config.headers.Authorization) {
            config.headers.HTTP_AUTHORIZATION = VueCookie.get('Authorization');
        }
        return axios.post(url, qs.stringify(data), config);
    }
}


//------------- axios -----------

/**
 * 跳转函数
 * 
 * @param  steing rurl
 */
global.goto = function(rurl) {
    window.location.href = "/#" + rurl;
}

/**
 * 检查是否登陆
 */
global.islogin = function() {
    let cookies = VueCookie.get('Authorization');
    if (cookies != "undefined" && typeof(cookies) == "string" && cookies != '') {

        return true;

    }

    return false;
}

global.objectToArray = function(obj) {
    let arr = [];
    for (let key in obj) {
        arr.push(obj[key]);
    }
    return arr;
}