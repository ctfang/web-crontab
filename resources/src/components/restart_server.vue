<template>
    <div>
        <div style="display:flex;justify-content:center;margin-top:30px;height:80px;" v-loading="loading2"
    element-loading-text="重启中">

        </div>
        <el-row style="margin-top:30px;text-align:center">
            <router-link to="/index/add_plan"><el-button type="primary">取消</el-button></router-link>
        </el-row>
    </div>
</template>

<script>
  export default {
    data() {
        return {
            loading2: true
        }
    },
    methods: {

    }
  }
</script>