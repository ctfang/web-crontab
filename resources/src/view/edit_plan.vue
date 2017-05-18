<template>
	<el-form  ref="form" :model="form" label-width="80px">
	  <el-form-item label="方案名称">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="备注">
		<el-input v-model="form.remask"></el-input>
	  </el-form-item>
	  <el-form-item>
		<el-button type="primary" @click="onSubmit">保存</el-button>
		<router-link to="/index/plan_list"><el-button>返回列表页</el-button></router-link>
	  </el-form-item>
	</el-form>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          name: '',
          remask: '',
        }
      }
    },
    methods: {
      onSubmit(){
        http.post('/plan/edit',this.form)
		.then((result)=>{
			router.push('/index/plan_list');
		})
      }
    }
  }
</script>