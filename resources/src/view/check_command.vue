<template>
    <div>
        <el-row style="text-align:center">
            <el-steps :space="200" :active="index">
                <el-step title="检查命令" description=""></el-step>
                <el-step title="使用命令" description=""></el-step>
                <el-step title="等待服务器重启" description=""></el-step>
                <el-step title="完成" description=""></el-step>
            </el-steps>
        </el-row>
        <div v-if="index == 1">
            <check-command v-on:selectOption='selectOption'></check-command>
        </div>
        <div v-else-if="index == 2">
            <use-command  v-on:selectOption='selectOption' ></use-command>
        </div>
        <div v-else-if="index == 3">
            <restart-server  v-on:selectOption='selectOption'></restart-server>
        </div>
        <div v-else>
            <complete></complete>
        </div>
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
    import check_command from '@/components/check_command';
    import use_command from '@/components/use_command';
    import restart_server from '@/components/restart_server';
    import complete from '@/components/complete';
  export default {
    data() {
        return {
            form:{
                name:'',
                remark:'',
            },
            tableData:[],
            dialogFormVisible: false,
            index:1
        }
    },
    components: {
        'check-command': check_command,
        'use-command': use_command,
        'restart-server': restart_server,
        'complete':complete,
    },
    methods: {
        selectOption(index){
            this.index = index;
            this.dialogFormVisible = true;
        },
        onSubmit(){
            this.index = 3;
            http.post('/cron/make/release',this.form)
            .then((res)=>{
                if(res.data.statusCode==10001){
                    setTimeout(()=>{
                        this.index = 4;
                    },2000)
                }
            })
        }, 

    }
  }
</script>