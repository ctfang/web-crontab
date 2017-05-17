<template>
	<el-form  ref="form" :model="form" label-width="80px">
	  <el-form-item label="方案名称">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="备注">
		<el-input v-model="form.remask"></el-input>
	  </el-form-item>
	  <el-form-item>
		<el-button type="primary" @click="onSubmit">立即创建</el-button>
		<el-button>取消</el-button>
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
	  console.log(this.form)
        http.post('/plan/store',this.form)
		.then((result)=>{
			router.push('/index/plan_list');
		})
      }
    }
  }
</script>