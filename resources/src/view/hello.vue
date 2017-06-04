<template>
  <div id="hello">
  <img src="../assets/logo.png">
    <h1>{{ msg }}</h1>
    <h2>web-crontab</h2>
    <ul>
      <li><router-link to="/index/plan_list" >前去管理</router-link></li>
      <li><router-link href="https://gitter.im/vuejs/vue" target="_blank">修改密码</router-link></li>
      <li><router-link href="#logout" target="_blank">退出登录</router-link></li>
      <li><a href="http://vuejs-templates.github.io/webpack/" target="_blank">查看使用教程</a></li>
    </ul>
    <h2>联系</h2>
    <ul>
      <li><a href="https://github.com/selden1992/web-crontab" target="_blank">GitHub</a></li>
      <li><a href="http://vuex.vuejs.org/" target="_blank">Email</a></li>
      <li><a href="https://github.com/selden1992/web-crontab/blob/master/README.md" target="_blank">Docs</a></li>
      <li><a href="https://github.com/vuejs/awesome-vue" target="_blank">Blog</a></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: '欢迎使用 WEB-CRONTAB 管理定时任务'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#hello {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
