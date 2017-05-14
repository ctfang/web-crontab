import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/view/hello'
import login from '@/view/login'
import Index from '@/view/index'
import home from '@/view/home'
import task from '@/view/task'
import add_command from '@/view/add_command'
import command_list from '@/view/command_list'
import add_plan from '@/view/add_plan'
import plan_list from '@/view/plan_list'

Vue.use(Router)

export default new Router({
	mode: 'history',
  routes: [
	{
		path:'/index',
		name:'Index',
		component:Index,
		children:[
			{
				path: '',
				component: task
			},
			{
				path: 'task',
				name:'Task',
				component: task
			},
			{
				path:'add_command',
				name:'add_command',
				component: add_command,
			},
			{
				path:'command_list',
				name:'command_list',
				component: command_list,
			},
			{
				path:'add_plan',
				name:'add_plan',
				component: add_plan,
			},
			{
				path:'plan_list',
				name:'plan_list',
				component: plan_list,
			}
		]
	},
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
  ]
})
