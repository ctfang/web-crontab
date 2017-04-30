import VueCookie from 'vue-cookie';

global.VueCookie = VueCookie;


//------------- axios -----------
//
import axios from 'axios'
global.http = axios.create({
  baseURL: 'http://www.web-cron.app/',
  timeout: 1000,
  // 跨域不能设置头
  // headers: {
  // 	//'Content-Type' : 'application/x-www-form-urlencoded',
  // 	//'Authorization':'123'
  // }
});


//------------- axios -----------

/**
 * 跳转函数
 * 
 * @param  steing rurl
 */
global.goto = function (rurl){
	window.location.href="/#"+rurl;
} 

/**
 * 检查是否登陆
 */
global.islogin = function (){

  if( VueCookie.get('Authorization')!="undefined" && typeof(VueCookie.get('Authorization'))=="string" ){

    return true;

  }

	return false;
}
