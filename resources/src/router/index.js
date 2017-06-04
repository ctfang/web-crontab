import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/view/hello'
import login from '@/view/login'
import Index from '@/view/index'
import home from '@/view/home'
import task from '@/view/task'
import add_command from '@/view/add_command'
import add_plan from '@/view/add_plan'
import plan_list from '@/view/plan_list'
import edit_plan from '@/view/edit_plan'
import plan_info from '@/view/plan_info'
import not_found from '@/view/not_found'
import permission from '@/view/permission'
import edit_command from '@/view/edit_command'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [{
            path: '/index',
            name: 'Index',
            component: Index,
            children: [{
                    path: '',
                    component: plan_list
                },
                {
                    path: 'add_command/:plan_name',
                    name: 'add_command',
                    component: add_command,
                },
                {
                    path: 'add_plan',
                    name: 'add_plan',
                    component: add_plan,
                },
                {
                    path: 'plan_list',
                    name: 'plan_list',
                    component: plan_list,
                },
                {
                    path: 'edit_plan',
                    name: 'edit_plan',
                    component: edit_plan,
                },
                {
                    path: 'plan_info/:name',
                    name: 'plan_info',
                    component: plan_info,
                },
                {
                    path: 'edit_command/:name/:id',
                    name: 'edit_command',
                    component: edit_command,
                },
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
        // 没有权限
        {
            path: '/permission',
            component: permission
        },
        { path: '*', component: not_found }
    ]
})