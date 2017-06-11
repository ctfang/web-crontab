<template>
	<el-form  ref="form" :model="form" label-width="80px">
	  <el-form-item label="方案名称">
		<el-input v-model="form.plan_name" :disabled="true"></el-input>
	  </el-form-item>
	  <el-form-item label="运行用户">
		<el-input v-model="form.run_user"></el-input>
	  </el-form-item>
	  <el-form-item label="月">
		<el-input v-model="form.cronteb.month"></el-input>
	  </el-form-item>
	  <el-form-item label="周">
		<el-input v-model="form.cronteb.week"></el-input>
	  </el-form-item>
	  <el-form-item label="日">
		<el-input v-model="form.cronteb.day"></el-input>
	  </el-form-item>
	  <el-form-item label="小时">
		<el-input v-model="form.cronteb.hour"></el-input>
	  </el-form-item>
	  <el-form-item label="分钟">
		<el-input v-model="form.cronteb.minute"></el-input>
	  </el-form-item>
	  <el-form-item label="具体命令">
		<el-input v-model="form.cronteb.cmd"></el-input>
	  </el-form-item>
	  <el-form-item label="备注">
		<el-input v-model="form.remark"></el-input>
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
            cronteb:{
                minute:'',
                hour:'',
                day:'',
                week:'',
                cmd:'',
                month:'',
            },
            remark:'',
            run_user:'',
            plan_name:this.$route.params.name,
            id:this.$route.params.id,
        }
      }
    },
    methods: {
      onSubmit() {
        http.post('/cron/edit',this.form)
        .then((res)=>{
            if(res.data.statusCode=='10001'){
                this.$router.push({name:'plan_list',params:{name:this.$route.params.name}});
            }
        })
        console.log('submit!');
      }
    }
  }
</script>