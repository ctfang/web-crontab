<template>
	<div id="page">
		<el-row>
			<el-col :span="24"><div class="top-title">欢迎使用 WEB-CRONTAB</div></el-col>
		</el-row>

		<el-form ref="ruleForm" :rules="rules" :model="ruleForm" label-width="80px">
			<el-form-item label="用户名称" prop="username">
				<el-input v-model="ruleForm.username"></el-input>
			</el-form-item>
			<el-form-item label="密码" prop="password">
				<el-input v-model="ruleForm.password"></el-input>
			</el-form-item>
			<el-form-item label="记住密码" prop="delivery">
				<el-switch on-text="" off-text="" v-model="ruleForm.delivery"></el-switch>
			</el-form-item>
			<el-form-item>
				<el-button type="primary" @click="submitForm('ruleForm')">登陆</el-button>
				<el-button>取消</el-button>
			</el-form-item>
		</el-form>
</div>
</template>

<script>
	import VueCookie from 'vue-cookie';

	export default {
		name: 'page',
		data () {
			return {
				ruleForm: {
					username: '',
					password: '',
					delivery: false,
				},
				dialogVisible: false,
				rules: {
				  username: [
					{ required: true, message: '请输入用户名', trigger: 'blur' },
					{ min: 3, max: 20, message: '长度在 3 到 20 个字符', trigger: 'blur' },
				  ],
				  password: [
					{ required: true, message: '请输入密码', trigger: 'blur' },
					{ min: 4, max: 20, message: '长度在 4 到 20 个字符', trigger: 'blur' }
				  ]
				},
			}
		},
		methods: {
			submitForm(formName) {
				this.$router.push('/index');
				var formData = this.ruleForm; // 表单数据
				var _this   = this;
				var qs = require('qs');
				this.$refs[formName].validate((valid) => {
				  if (valid) {
					http.post('/login', {
						username: formData.username,
						password: formData.password,
						delivery: formData.delivery,
					})
					.then(function (response) {
						if(response.data.statusCode==10001){
							VueCookie.set('Authorization', response.data.arrData.Authorization,24*3600);						
							console.log(response.data.arrData.Authorization);
							this.$router.push('/index');
						}else{
							console.log('login false');
							_this.$message({type: 'warning',showClose: true,'message':'账号密码错误！'});
						}
						
					})
					.catch(()=>{
						_this.$message({type: 'error',showClose: true,'message':'网络错误！'});
					})
				  } else {
					console.log('error submit!!');
					return false;
				  }
				});
				
			},
			handleClose(done) {
				this.$confirm('确认关闭？')
				.then(_ => {
					done();
				})
				.catch(_ => {});
			}
		}
	}
</script>

<style>

	.el-row {
		margin-bottom: 20px;
	}
	.el-col {
		border-radius: 4px;
	}
	.top-title{
		font-size: 200%;
		font-weight: 900;
		text-align:center;
	}
</style>


