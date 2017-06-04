<template>
	<div>
		<el-row :gutter="20">
			<el-menu theme="dark" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
				<el-col :span="12" :offset="6">

					<el-menu-item index="1">处理中心</el-menu-item>
					<el-menu-item index="2">处理中心</el-menu-item>
					<el-menu-item index="3">处理中心</el-menu-item>
					<el-menu-item index="4">处理中心</el-menu-item>
					<el-menu-item index="5">处理中心</el-menu-item>
					<el-menu-item index="6"><a href="https://www.ele.me" target="_blank">订单管理</a></el-menu-item>

				</el-col>
			</el-menu>
		</el-row>	

		<router-view></router-view>
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
	body {
		display: block;
		margin: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		margin-left: 0px;
	}
</style>