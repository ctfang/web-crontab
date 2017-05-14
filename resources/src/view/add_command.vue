<template>
	<el-form  ref="form" :model="form" label-width="80px">
	  <el-form-item label="方案名称">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="运行用户">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="月">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="周">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="日">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="小时">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="分钟">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="具体命令">
		<el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item label="备注">
		<el-input v-model="form.name"></el-input>
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
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        }
      }
    },
    methods: {
      onSubmit() {
        console.log('submit!');
      }
    }
  }
</script>