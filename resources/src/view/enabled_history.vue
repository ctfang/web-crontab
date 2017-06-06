<template>
  <div>
    <el-table :data="tableData" border style="width: 100%">
      <el-table-column fixed prop="name" label="日期"> 
      </el-table-column>
      <el-table-column prop="remake" label="上线名称">
      </el-table-column>
      <el-table-column prop="created" label="说明">
      </el-table-column>
      <el-table-column prop="created" label="状态">
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
  
    methods: {


    },
    created() {

  
    },
    data() {
  
      return {
        tableData:[]
  
      }
  
    }
  
  }
</script>