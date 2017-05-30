<template>
  <div>
    <el-table :data="tableData" border style="width: 100%">
    
      <el-table-column fixed prop="name" label="方案名称">
        <template scope="data">
    
            <router-link :to="{name:'plan_info',params:{name:data.row.name}}">{{data.row.name}}</router-link>
  
        </template>
      </el-table-column>
    
      <el-table-column prop="remake" label="备注">
    
      </el-table-column>
    
      <el-table-column prop="created" label="创建时间">
    
      </el-table-column>
    
      <el-table-column fixed="right" label="操作" width="180">
    
        <template scope="scope">
    
            <router-link to='/index/edit_plan'><el-button type="text" size="small"><i class="el-icon-edit" /></el-button></router-link>
    
            <el-button type="text" @click="handleDelete(scope.$index,scope.row)"><i class="el-icon-delete" /></el-button>
    
            <el-switch v-model="scope.row.statusKey" on-text="开" off-text="关"></el-switch>
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
  
      handleDelete(index, row) {
        console.log(index,row)
        http.get('/plan/destroy', {
  
            params: {
  
              'name': row.name
  
            }

          })
          .then((res) => {

            delete this.tableData[index];

          })
      }

    },
    created() {
      http.get('/plan/list').then((res) => {
        res.data.statusCode = 10001;
            res.data.arrData = [{
                "created":"2017-05-07 03:45:14",
                "name":"定时项目",
                "remake":"这是测试备注",
                "status":true
            },
            {
                "created":"2017-05-07 03:46:42",
                "name":"第二方案",
                "remake":"这是测试备注",
                "status":true
            }]
              if (res.data.statusCode == 10001) {

              res.data.arrData.forEach((value,index)=>{

                this['status'+index] = value.status;
                value['statusKey'] = 'status'+index;

              })
              this.tableData = res.data.arrData;
            } 
        })
  
    },
    data() {
  
      return {
  
        tableData: [],
        status1:true,
        status2:false
  
      }
  
    }
  
  }
</script>