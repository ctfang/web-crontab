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
import check_command from '@/view/check_command'
import enabled_history from '@/view/enabled_history'
import change_password from '@/view/change_password'

Vue.use(Router)

export default new Router({
    routes: [{
            path: '/index',
            name: 'Index',
            component: Index,
            children: [{
                    path: '',
                    name: 'default',
                    component: plan_list
                },
                {
                    path: 'add_command/:name',
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
                {
                    path: 'enabled_history',
                    name: 'enabled_history',
                    component: enabled_history,
                },
                {
                    path: 'check_command',
                    name: 'check_command',
                    component: check_command,
                },
                {
                    path:'change_password',
                    name:'change_password',
                    component:change_password,
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
            name: 'Login',
            component: login
        },
        // 没有权限
        {
            path: '/permission',
            name: 'Permission',
            component: permission
        },
        {
            path: '*',
            name: 'not_found',
            component: not_found,
        }
    ]
})