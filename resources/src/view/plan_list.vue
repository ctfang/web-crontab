<template>
  <div>
    <el-table :data="tableData" border style="width: 100%">
      <el-table-column fixed prop="name" label="方案名称">
        <template scope="data">
            <router-link :to="{name:'plan_info',params:{name:data.row.name}}">{{data.row.name}}</router-link>
        </template>
      </el-table-column>
      <el-table-column prop="remark" label="备注">
      </el-table-column>
      <el-table-column prop="created" label="创建时间">
      </el-table-column>
      <el-table-column fixed="right" label="操作" width="180">
        <template scope="scope">
            <el-button type="text" @click="handleDelete(scope.$index,scope.row)"><i class="el-icon-delete" /></el-button>
            <el-switch v-model="scope.row.status" on-text="开" off-text="关" @change='switchPlan(scope.row)'></el-switch>
        </template>
      </el-table-column>
    </el-table>
    <el-row style="margin-top:30px">
      <router-link to="/index/add_plan"><el-button type="primary">添加方案</el-button></router-link>
    </el-row>
  </div>
</template>

<script>
  export default {
  
    methods: {
      switchPlan(row){
        http.post('/plan/edit', {
          name:row.name,
          status:row.status==0?1:0,
          remark:row.remark,
        }).then((res)=>{
            if(res.data.statusCode===10000){
                this[row.statusKeyName] = row.status==0?true:false;
            }
        })
      },
      handleDelete(index, row) {
        http.get('/plan/destroy', {
  
            params: {
  
              'name': row.name
  
            }

          })
          .then((res) => {
            if( res.data.statusCode==10000 ){
              delete this.tableData.splice(index,1);
            }
          })
      }

    },
    created() {
      http.get('/plan/list').then((res) => {
        // res.data.statusCode = 10001;
        //     // res.data.arrData = [{
        //     //     "created":"2017-05-07 03:45:14",
        //     //     "name":"定时项目",
        //     //     "remark":"这是测试备注",
        //     //     "status":true
        //     // },
        //     // {
        //     //     "created":"2017-05-07 03:46:42",
        //     //     "name":"第二方案",
        //     //     "remark":"这是测试备注",
        //     //     "status":true
        //     // }]
            if (res.data.statusCode == 10001) {

              res.data.arrData.forEach((value,index)=>{

                this['status'+index] = value.status;
                value['statusKeyName'] = 'status'+index;
              })

              this.tableData = res.data.arrData;
              
            } 
        })
  
    },
    data() {
  
      return {
  
        tableData:[],
  
      }
  
    }
  
  }
</script>