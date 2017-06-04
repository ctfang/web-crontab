// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import '@/js-store/globals.js'
import Element from 'element-ui'
import 'element-ui/lib/theme-default/index.css'


Vue.use(Element)

Vue.config.productionTip = false


router.beforeEach(function(to, from, next) {
    if (to.path == '/login' || to.path == '/') {
        next();
    } else if (to.path == '/logout') {
        VueCookie.set('Authorization');
        console.log("退出登陆");
        next("/");
    } else {
        // 验证的路由
        if (islogin() == false) {
            console.log("没有登陆重定向");
            next("/login");
        } else {
            next();
        }
    }

})

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
})