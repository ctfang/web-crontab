import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/view/hello'
import login from '@/view/login'
import home from '@/view/home'

Vue.use(Router)

export default new Router({
  routes: [
  	// 欢迎页面
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    // 登陆页面
    {
      path: '/login',
      component: login
    },
    {
      path: '/home',
      component: home
    }
  ]
})
