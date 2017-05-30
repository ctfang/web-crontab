<template>
        <div>
                <h2>方案详情</h2>
                <el-row>
                        <el-col :span="3">方案名称：</el-col>
                        <el-col :span="10">{{name}}</el-col>
                </el-row>
                <el-row>
                        <el-col :span="3">备注：</el-col>
                        <el-col :span="10">{{remake}}</el-col>
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
                  prop="name"
                  label="编号"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="runUser"
                  label="运行用户"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="remake"
                  label="备注"
                  :span="3">
                </el-table-column>
                <el-table-column
                  prop="cmd"
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
                </el-table-column>

          </el-table>
          <el-row style="margin-top:20px">
                <router-link to="/index/add_command"><el-button type="primary">添加命令</el-button></router-link>
                <router-link to="/index/plan_list"><el-button>返回列表</el-button></router-link>
          </el-row>
         </div>
</template>

<script>
  export default {

    methods: {

    },
    created(){
        http.get('/plan/list')
        .then((res)=>{
                let data = res.data.arrData;
                data = {
                    name:'test',
                    created:"123",
                    remake:123,
                    status:true,
                    cron_list:[{
                        name:'测试',
                        runUser:'cmd',
                        remake:'test',
                        cmd:'123',
                        created:'123456',
                        status:true
                    }]
                }

                this.name = data.name;
                this.created = data.created;
                this.remake = data.remake;
                this.status = data.status;
                this.tableData = data.cron_list;
        })
    },
    data() {
      return {
        tableData: [],
        created:"",
        name:"",
        remake:"",
        status:'',
      }
    }
  }
  </script>