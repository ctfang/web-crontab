<template>
	<div class="container-flex" >
		<el-menu theme="light" :default-active="activeIndex" class="el-menu-demo" style="display:flex;justify-content:flex-end"  mode="horizontal">
			<h3 style="position:absolute;left:30px;color:#555">WEB-CRONTAB</h3>
			<router-link to="/index/plan_list"><el-menu-item index="1">方案管理</el-menu-item></router-link>
			<router-link to="/index/check_command"><el-menu-item index="2" @click="tip">启用管理</el-menu-item></router-link>
			<router-link to="/index/enabled_history"><el-menu-item index="3" @click="tip">启用历史</el-menu-item>	</router-link>		
			<el-menu-item index="4" @click="tip">用户管理</el-menu-item>
			<el-submenu index="5">
				<template slot="title">ADMIN</template>
				<el-menu-item index="5-1" @click="outLogin">退出</el-menu-item>
			</el-submenu>
		</el-menu>
		<el-row class="tac conatiner-main">
			<el-col :span="24">
				<div>
					<div class="container-title">
						<el-breadcrumb separator="/">
						  <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
						  <el-breadcrumb-item>方案管理</el-breadcrumb-item>
						</el-breadcrumb>
					</div>
					<div class="container">
						<el-row type="flex" class="row-bg" justify="center">
							<el-col :span="22" class="block">
								<router-view></router-view>
							</el-col>
						</el-row>
					</div>
				</div>
			</el-col>
		</el-row>
	</div>
</template>

<script>
  export default {
    data() {
      return {
        activeIndex: '1',
        activeIndex2: '1'
      };
    },
    methods: {
			tip(){
				//this.$message({type: 'warning',showClose: true,'message':'该功能正在开发中！'});
			},
			outLogin(){
				VueCookie.set('Authorization', '');
				this.$router.push('/');
			}
    }
  }
</script>
<style>


	.container-title{
		background-color:#fff;
		padding:15px 20px;
		margin-bottom:20px;
	}
</style>
