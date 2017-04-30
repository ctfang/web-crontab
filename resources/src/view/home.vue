<template>
	<div>
		<el-row :gutter="20">
			<el-menu theme="dark" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
				<el-col :span="12" :offset="6">
					<el-menu-item index="0">首页</el-menu-item>
					<el-menu-item index="1">运行状态</el-menu-item>
					<el-menu-item index="2">方案管理</el-menu-item>
					<el-menu-item index="3">启用日记</el-menu-item>
					<el-menu-item index="4">用户管理</el-menu-item>
					<el-menu-item index="5"><a href="https://www.ele.me" target="_blank">反馈BUG</a></el-menu-item>
					<el-menu-item index="6"><a href="#logout" target="">退出</a></el-menu-item>
				</el-col>
			</el-menu>
		</el-row>	

		<el-row :gutter="20">
			<el-col :span="22" :offset="1">
				<el-collapse v-model="activeNames" @change="handleChange">

					<el-collapse-item title="test项目定时任务" name="1">

						<el-table :data="tableData" border style="width: 100%">
							<el-table-column label="日期" width="180">
								<template scope="scope">
									<el-icon name="time"></el-icon>
									<span style="margin-left: 10px">{{ scope.row.date }}</span>
								</template>
							</el-table-column>
							<el-table-column label="姓名" width="180">
								<template scope="scope">
									<el-popover trigger="hover" placement="top">
										<p>姓名: {{ scope.row.name }}</p>
										<p>住址: {{ scope.row.address }}</p>
										<div slot="reference" class="name-wrapper">
											<el-tag>{{ scope.row.name }}</el-tag>
										</div>
									</el-popover>
								</template>
							</el-table-column>
							<el-table-column label="操作">
								<template scope="scope">
									<el-switch v-model="value3" on-color="#13ce66" off-color="#ff4949" on-value="100" off-value="0"> </el-switch>
								</template>
							</el-table-column>
						</el-table>

					</el-collapse-item>


					<el-collapse-item title="反馈 Feedback" name="2">
						<el-table :data="tableData" border style="width: 100%">
							<el-table-column prop="date" label="创建日期" width="180"> </el-table-column>
							<el-table-column prop="name" label="命令" width="180"> </el-table-column>
							<el-table-column prop="address" label="操作"> </el-table-column>
						</el-table>
					</el-collapse-item>

				</el-collapse>
			</el-col>
		</el-row>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				activeIndex: '1',
				activeIndex2: '1',
				tableData: [{
					date: '2016-05-02',
					name: '王小虎',
					address: '上海市普陀区金沙江路 1518 弄'
				}, {
					date: '2016-05-04',
					name: '王小虎',
					address: '上海市普陀区金沙江路 1517 弄'
				}, {
					date: '2016-05-01',
					name: '王小虎',
					address: '上海市普陀区金沙江路 1519 弄'
				}, {
					date: '2016-05-03',
					name: '王小虎',
					address: '上海市普陀区金沙江路 1516 弄'
				}],
				// 是否展开
				activeNames: ['1','2','3','5'],

				value3: '100',
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

</style>