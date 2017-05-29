import VueCookie from 'vue-cookie';

global.VueCookie = VueCookie;


//------------- axios -----------
//
import axios from 'axios'
global.http = {
    config: {
        baseURL: 'http://localhost:1080/index.php',
        timeout: 1000,
        // 跨域不能设置头
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },

    },
    get(url, config = {}) {
        config = Object.assign(this.config, config);
        if (config.headers && config.headers.Authorization || config.headers.Authorization) {
            config.headers.Authorization = VueCookie.get('Authorization');
        }
        return axios.get(url, config);
    },
    post(url, data, config = {}) {
        config = Object.assign(this.config, config);
        if (config.headers && config.headers.Authorization || config.headers.Authorization) {
            config.headers.Authorization = VueCookie.get('Authorization');
        }
        return axios.post(url, data, config);
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

    if (VueCookie.get('Authorization') != "undefined" && typeof(VueCookie.get('Authorization')) == "string") {

        return true;

    }

    return false;
}