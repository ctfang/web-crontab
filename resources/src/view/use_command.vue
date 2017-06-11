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

        <el-dialog title="确认使用" :visible.sync="dialogFormVisible">
        <el-form :model="form">
            <el-form-item label="历史名称" :label-width="formLabelWidth">
                <el-input v-model="form.name" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="细节说明" :label-width="formLabelWidth">
                <el-input v-model="form.remark" auto-complete="off"></el-input>
            </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
            <el-button @click="dialogFormVisible = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit" @click="dialogFormVisible = false">确 定</el-button>
        </div>
        </el-dialog>
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
            })
        },      
    }
  }
</script>