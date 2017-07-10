<template>
	<el-form  ref="form" :model="form" label-width="80px">
	  <el-form-item label="方案名称">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.plan_name" :disabled="true"></el-input>
				</el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="运行用户">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.runUser"></el-input>
				</el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="月">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.cmd.month"></el-input>
				</el-col>
				<el-col :span="8" class="tip"> 1-12 或者 JAN-DEC , - *  </el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="周">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.cmd.week"></el-input>
				</el-col>
				<el-col :span="8" class="tip"> 1-7 或者 SUN-SAT , - * ? / L C # </el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="日">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.cmd.day"></el-input>
				</el-col>
				<el-col :span="8" class="tip"> 1-31 , - * ? / L W C  </el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="小时">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.cmd.hour"></el-input>
				</el-col>
				<el-col :span="8" class="tip">  0-23 , - * </el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="分钟">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.cmd.minute"></el-input>
				</el-col>
				<el-col :span="8" class="tip">  0-59 , - *  </el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="具体命令">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.cmd.cmd"></el-input>
				</el-col>
			</el-row>
	  </el-form-item>
	  <el-form-item label="备注">
			<el-row>
				<el-col :span="8">
					<el-input v-model="form.remark"></el-input>
				</el-col>
			</el-row>
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
            cmd:{
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
		created(){
			http.get('/cron/show',{
				params:{
					id:this.$route.params.id,
					plan_name:this.$route.params.name,
				}
			})
			.then((res)=>{
				if(res.data.statusCode=='10001'){
					this.form = res.data.arrData;
					this.form.plan_name = this.$route.params.name
					console.log(this.form)
				}
				if(res.data.statusCode==40002){
							this.$router.push('/login');
				}
			})
		},
    methods: {
      onSubmit() {
				let data = JSON.parse(JSON.stringify(this.form));
				data.cronteb = data.cmd;
				delete data.cmd;
        http.post('/cron/edit',data)
        .then((res)=>{
            if(res.data.statusCode==10000){
                this.$router.push({name:'plan_list',params:{name:this.$route.params.name}});
            }
						if(res.data.statusCode==40002){
									this.$router.push('/login');
						}
        })
        console.log('submit!');
      }
    }
  }
</script>


<style scoped>
.tip{
	color:#ccc;
	text-indent:2em;
}
</style>