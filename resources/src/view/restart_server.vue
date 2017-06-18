<template>
    <div>
        <el-steps :space="200" :active="3">
            <el-step title="检查命令" description=""></el-step>
            <el-step title="使用命令" description=""></el-step>
            <el-step title="等待服务器重启" description=""></el-step>
            <el-step title="完成" description=""></el-step>
        </el-steps>
        <el-table :data="tableData" border style="width: 100%">
        <el-table-column fixed prop="name" label="运行用户">
        </el-table-column>
        <el-table-column prop="remark" label="时间">
        </el-table-column>
        <el-table-column prop="created" label="命令">
        </el-table-column>
        </el-table>
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
            tableData:[]
        }
    },
    methods: {

    }
  }
</script>