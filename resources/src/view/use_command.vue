<template>
    <div>
        <el-steps :space="200" :active="2">
            <el-step title="检查命令" description=""></el-step>
            <el-step title="使用命令" description=""></el-step>
            <el-step title="等待服务器重启" description=""></el-step>
            <el-step title="完成" description=""></el-step>
        </el-steps>
        <el-table :data="tableData" border style="width: 100%">
        <el-table-column fixed prop="runUser" label="运行用户">
        </el-table-column>
        <el-table-column prop="created" label="时间">
        </el-table-column>
        <el-table-column prop="cmd.cmd" label="命令">
        </el-table-column>
        </el-table>
        <el-row style="text-align:center;margin-top:15px;">
            <el-button @click="dialogFormVisible = true">确认按钮</el-button>
        </el-row>

    </div>
</template>

<script>
  export default {
    data() {
        return {
            dialogFormVisible: false,
            form:{
                name:'',
                remark:'',
            },
            tableData:[]
        }
    },

    created(){
        http.post('/cron/list')
        .then((res)=>{
            this.tableData = res.data;
        })
    },
    methods: {
         onSubmit(){
            http.post('/cron/make/release',this.form)
            .then((res)=>{
                if(res.data.statusCode==10001){
                    this.$router.push('/index/restart_server');
                }
                if(res.data.statusCode==40002){
                     this.$router.push('/login');
                }
            })
        },      
    }
  }
</script>