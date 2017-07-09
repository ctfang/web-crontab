<template>
	<div id="page" style="width:500px;margin:100px auto">
		<el-form ref="ruleForm" :rules="rules" :model="ruleForm" label-width="80px">
			<el-form-item label="密码" prop="password">
				<el-input v-model="ruleForm.password"></el-input>
			</el-form-item>
			<el-form-item label="确认密码" prop="check_password">
				<el-input v-model="ruleForm.check_password"></el-input>
			</el-form-item>
			<el-form-item>
				<el-button type="primary" @click="submitForm('ruleForm')">保存修改</el-button>
			</el-form-item>
		</el-form>
</div>
</template>

<script>
	import VueCookie from 'vue-cookie';

	export default {
		name: 'page',
		data () {
            var validatePass2 = (rule, value, callback) => {
                if (value === '') {
                callback(new Error('请再次输入密码'));
                } else if (value !== this.ruleForm.password) {
                callback(new Error('两次输入密码不一致!'));
                } else {
                callback();
                }
            };
			return {
				ruleForm: {
					username: '',
					password: '',
					delivery: false,
				},
				dialogVisible: false,
				rules: {
				  password: [
					{ required: true, message: '请输入密码', trigger: 'blur' },
					{ min: 4, max: 20, message: '长度在 4 到 20 个字符', trigger: 'blur' }
				  ],
				  check_password: [
					{ required: true, message: '请确认密码', trigger: 'blur' },
					{ validator:validatePass2, trigger: 'blur' }
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
						http.post('/user/edit_password', {
                            check_password: formData.check_password,
							password: formData.password,
						})
						.then( (response) =>{
							console.log(response)
							if(response.data.statusCode==10001){
								VueCookie.set('Authorization', response.data.arrData.Authorization,24*3600);						
								console.log(response.data.arrData.Authorization);
								this.$router.push('/index');
							}else{
								console.log('login false');
								this.$message({type: 'warning',showClose: true,'message':'账号密码错误！'});
							}
							
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


