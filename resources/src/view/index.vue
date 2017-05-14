<template>
	<div class="container-flex" >
		<el-menu theme="light" :default-active="activeIndex" class="el-menu-demo"  mode="horizontal" @select="handleSelect">
		  <el-menu-item index="1">处理中心</el-menu-item>
		  <el-submenu index="2">
			<template slot="title">我的工作台</template>
			<el-menu-item index="2-1">选项1</el-menu-item>
			<el-menu-item index="2-2">选项2</el-menu-item>
			<el-menu-item index="2-3">选项3</el-menu-item>
		  </el-submenu>
		  <el-menu-item index="3"><a href="https://www.ele.me" target="_blank">订单管理</a></el-menu-item>
		</el-menu>
		<el-row class="tac conatiner-main">
			 <el-col :span="3" style="height:100%">
				<el-menu default-active="2" style='height:100%' class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" theme="dark">
				  <el-submenu index="1">
					<template slot="title">命令操作</template>
						<router-link to="/index/command_list">
							<el-menu-item index="1-1">命令列表</el-menu-item>
						</router-link>
						<router-link to="/index/add_command">
							<el-menu-item index="1-2">添加命令</el-menu-item>
						</router-link>
				  </el-submenu>
				  <el-submenu index="2">
					<template slot="title">方案管理</template>
						<router-link to="/index/plan_list">
							<el-menu-item index="2-1">方案列表</el-menu-item>	
						</router-link>
						<router-link to="/index/add_plan">
							<el-menu-item index="2-1">添加方案</el-menu-item>
						</router-link>
				  </el-submenu>
				</el-menu>
			 </el-col>
			<el-col :span="21">
				<div>
					<div class="container-title">
						<el-breadcrumb separator="/">
						  <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
						  <el-breadcrumb-item>活动管理</el-breadcrumb-item>
						  <el-breadcrumb-item>活动列表</el-breadcrumb-item>
						  <el-breadcrumb-item>活动详情</el-breadcrumb-item>
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
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>
<style>

	.container-flex{
		width:100%;
		height:100%;
		display:flex;
		flex-direction: column;
		background-color:#e4e5e6;
	}
	.conatiner-main{
		flex:1;
		width:100%;
	}
	.container-title{
		background-color:#fff;
		padding:15px 20px;
		margin-bottom:20px;
	}
</style>
