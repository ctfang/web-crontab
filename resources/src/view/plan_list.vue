<template>
  <el-table
    :data="tableData"
    border
    style="width: 100%">
    <el-table-column
      fixed
      prop="name"
      label="方案名称"
      width="150">
    </el-table-column>
    <el-table-column
      prop="remake"
      label="备注"
      width="120">
    </el-table-column>
    <el-table-column
      prop="created"
      label="创建时间"
      width="120">
    </el-table-column>
    <el-table-column
      prop="status"
      label="状态"
      width="120">
    </el-table-column>
    <el-table-column
      fixed="right"
      label="操作"
      width="180">
      <template scope="scope">
        <el-button @click="handleClick" type="text" size="small">查看</el-button>
        <router-link to='/index/edit_plan'><el-button type="text" size="small">编辑</el-button></router-link>
		<el-button type="text" size="small" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
  export default {
 
    methods: {
      handleClick() {
        console.log(1);
      },
	  handleDelete(index,row){
		http.get('/plan/destroy',{params:{'name':row.name}})
		.then((res)=>{
			this.tableData = res.arrData;
		})		
	  }
    },
	created(){
			this.tableData = [{
				"created":"2017-05-07 03:45:14",
				"name":"定时项目",
				"remake":"这是测试备注",
				"status":true
			},
			{
				"created":"2017-05-07 03:46:42",
				"name":"第二方案",
				"remake":"这是测试备注",
				"status":true
			}];
		http.get('/plan/list')
		.then((res)=>{

		})
	},
    data() {
      return {
        tableData: []
      }
    }
  }
</script>