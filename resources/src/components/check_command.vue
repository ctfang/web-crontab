<template>
        <el-table :data="tableData" border style="width: 100%">
        <el-table-column fixed prop="runUser" label="运行用户">
        </el-table-column>
        <el-table-column prop="created" label="时间">
        </el-table-column>
        <el-table-column prop="cmd.cmd" label="命令">
        </el-table-column>
        </el-table>
        <el-row style="text-align:center;margin-top:15px;">
            <router-link to='/index/use_command'><el-button v-on:click='jump'>默认按钮</el-button></router-link>
        </el-row>
</template>
<script>
    export default {
        data() {
            return {
                tableData:[],
            }
        },
        created(){
            http.post('/cron/list')
            .then((res)=>{
                this.tableData = res.data;
            })
        },
        methods:{
            jump(){
                this.$emit('selectOption', 2 );
            }
        }
    }
</script>