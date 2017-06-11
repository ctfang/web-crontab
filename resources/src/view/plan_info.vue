<template>
        <div>
                <h2>方案详情</h2>
                <el-row>
                        <el-col :span="3">方案名称：</el-col>
                        <el-col :span="10">{{name}}</el-col>
                </el-row>
                <el-row>
                        <el-col :span="3">备注：</el-col>
                        <el-col :span="10">{{remark}}</el-col>
                </el-row>
                <el-row>
                        <el-col :span="3">创建时间：</el-col>
                        <el-col :span="10">{{created}}</el-col>
                </el-row>
                <el-row>
                        <el-col :span="3">状态：</el-col>
                        <el-col :span="10">{{status}}</el-col>
                </el-row>
          <el-table
                :data="tableData"
                border
                style="width: 100%">
                <el-table-column
                  prop="id"
                  label="编号"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="runUser"
                  label="运行用户"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="remark"
                  label="备注"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="cmd.cmd"
                  label="命令"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="created"
                  label="创建时间"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="status"
                  label="状态"
                  :span="3">
                  <template scope="data">
                      {{data.row.status?'开启':'关闭'}}
                  </template>
                </el-table-column>
                <el-table-column fixed="right" label="操作" width="180">
                  <template scope="scope">
                      <el-button type="text" @click="handleDelete(scope.$index,scope.row)"><i class="el-icon-delete" /></el-button>
                      <router-link :to="{name:'edit_command',params:{name:$route.params.name,id:scope.row.id}}"><el-button type="text" size="small"><i class="el-icon-edit" /></el-button></router-link>
                  </template>
                </el-table-column>
          </el-table>
          <el-row style="margin-top:20px">
                <router-link :to="{name:'add_command',params:{name:name}}"><el-button type="primary">添加命令</el-button></router-link>
                <router-link to="/index/plan_list"><el-button>返回列表</el-button></router-link>
          </el-row>
         </div>
</template>

<script>
  export default {

    methods: {
      switchPlan(){

      },
      handleDelete(index,row){
        http.post('/cron/destroy',{
          plan_name:this.$route.params.name,
          id:row.id,
        })
        .then((res)=>{
          if(res.data.statusCode==10000){
            this.tableData.splice(index,1);
          }
        })
      }
    },
    
    created(){
        http.get('/plan',{
          params:{
            name:this.$route.params.name,
          }
        })
        .then((res)=>{
          if(res.data.statusCode==10001){
                let data = res.data.arrData;
                // data = {
                //     name:'test',
                //     created:"123",
                //     remark:123,
                //     status:true,
                //     cron_list:[{
                //         name:'测试',
                //         runUser:'cmd',
                //         remark:'test',
                //         cmd:'123',
                //         created:'123456',
                //         status:true
                //     }]
                // }

                this.name = data.name;
                this.created = data.created;
                this.remark = data.remark;
                this.status = data.status;
                this.tableData = objectToArray(data['cmd-list']);
          }
        })
    },
    data() {
      return {
        tableData: [],
        created:"",
        name:"",
        remark:"",
        status:'',
      }
    }
  }
  </script>