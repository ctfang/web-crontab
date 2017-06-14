<template>
  <div>
    <el-table :data="tableData" border style="width: 100%">
      <el-table-column fixed prop="date" label="日期"> 
      </el-table-column>
      <el-table-column prop="tittle" label="上线名称">
      </el-table-column>
      <el-table-column prop="remark" label="说明">
      </el-table-column>
      <el-table-column prop="status" label="状态">
        <template scope='data'>
          {{data.status==0?'关闭':'开启'}}
        </template>
      </el-table-column>
      <el-table-column fixed="right" label="操作" width="180">
        <template scope="scope">
            <el-button type="text" >回滚</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  export default {
    created() {
      http.post('/release/list')
      .then((res)=>{
          if(res.data.statusCode==10001){
            console.log(res.data.arrData.data.list)
            this.tableData = res.data.arrData.data.list;
          }
      })
  
    },
    data() {
      return {
        tableData:[]
  
      }

    }
  
  }
</script>