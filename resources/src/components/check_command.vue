<template>
    <div>
        <el-table :data="tableData" border style="width: 100%">
        <el-table-column fixed prop="runUser" label="运行用户">
        </el-table-column>
        <el-table-column prop="created" label="时间">
        </el-table-column>
        <el-table-column prop="cmd.cmd" label="命令">
        </el-table-column>
        </el-table>
        <el-row style="text-align:center;margin-top:15px;">
            <el-button v-on:click='jump'>默认按钮</el-button>
        </el-row>
    </div>
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
               if(res.data.statusCode==10001){
                    this.tableData = res.data.arrData;
                }
                if(res.data.statusCode==40002){
                     this.$router.push('/login');
                }
            })
        },
        methods:{
            jump(){
                this.$emit('selectOption', 2 );
            }
        }
    }
</script>