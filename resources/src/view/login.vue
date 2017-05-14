<template>
	<div id="page">
		<el-row>
			<el-col :span="24"><div class="top-title">欢迎使用 WEB-CRONTAB</div></el-col>
		</el-row>

		<el-form ref="form" :model="form" label-width="80px">
			<el-form-item label="用户名称">
				<el-input v-model="form.username"></el-input>
			</el-form-item>
			<el-form-item label="密码">
				<el-input v-model="form.password"></el-input>
			</el-form-item>
			<el-form-item label="记住密码">
				<el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>
			</el-form-item>
			<el-form-item>
				<el-button type="primary" @click="onSubmit">登陆</el-button>
				<el-button>取消</el-button>
			</el-form-item>
		</el-form>

		<el-dialog title="提示" v-model="dialogVisible" size="tiny" :before-close="handleClose">
		<span>账号密码错误</span>
		<span slot="footer" class="dialog-footer">
			<el-button @click="dialogVisible = false">取 消</el-button>
			<el-button type="primary" @click="dialogVisible = false">确 定</el-button>
		</span>
	</el-dialog>

</div>
</template>

<script>
	import VueCookie from 'vue-cookie';

	export default {
		name: 'page',
		data () {
			return {
				form: {
					username: '',
					password: '',
					delivery: false,
				},
				dialogVisible: false,
			}
		},
		methods: {
			onSubmit() {
				var formData = this.form; // 表单数据
				var paren   = this;
				var qs = require('qs');

				http.post('/login', qs.stringify({
					username: formData.username,
					password: formData.password,
					delivery: formData.delivery,
				}))
				.then(function (response) {
					if(response.data.statusCode==10001){
						VueCookie.set('Authorization', response.data.arrData.Authorization,24*3600);						
						console.log(response.data.arrData.Authorization);
						goto('/home');
					}else{
						console.log('login false');
						paren.dialogVisible = true;
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


