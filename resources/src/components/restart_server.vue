<template>
    <div>
        <div style="display:flex;justify-content:center;margin-top:30px">
            <el-progress type="circle" :percentage="25"></el-progress>
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
 
        }
    },
    methods: {

    }
  }
</script>