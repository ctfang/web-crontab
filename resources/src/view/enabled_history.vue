<template>
  <div>
        <div style="position:absolute;top:100px;height:80px;width:80px;left:50%;margin-left:-40px;" v-loading="loading2"
    element-loading-text="重启中"></div>
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
            <el-button type="text" @click="backFun(scope.row)" >回滚</el-button>
        </template>
      </el-table-column>
    </el-table>
    <div class="block">
      <el-pagination
        @current-change="handleCurrentChange"
        :current-page="currentPage"
        :page-size="30"
        :page-count="pageCount"
        layout="prev, pager, next"
        >
      </el-pagination>
    </div>
  </div>
</template>

<script>
  export default {
    created() {
      http.get('/release/list')
      .then((res)=>{
          if(res.data.statusCode==10001){
            let data =  res.data.arrData;
            this.tableData = data.data.list;
            this.currentPage = data.first_page;
            this.pageCount = data.last_page;
          }
          if(res.data.statusCode==40002){
                this.$router.push('/login');
          }
      })
  
    },
    data() {
      return {
        tableData:[],
        loading2:false,
        time:0
      }

    },
    methods:{
      handleCurrentChange(page){
        http.get('/release/list',{
          params:{
            page:page,
          }
        })
        .then((res)=>{
           if(res.data.statusCode==10001){
            let data =  res.data.arrData;
            this.tableData = data.data.list;
            this.currentPage = data.first_page;
            this.pageCount = data.last_page;
          }
          if(res.data.statusCode==40002){
                this.$router.push('/login');
          }        
        })
      },
      backFun(row){
        console.log(row)
        this.loading2=true;
        http.post('/rollback/release',{
          'id':row.id,
          'path':row.path
        })
        .then((res)=>{
            if(this.time>=60){
                this.loading2=false;
                this.$message({type: 'warning',showClose: true,'message':'请求超时，请刷新页面！'});
                return false;
            }
            if(res.data.arrData.id==row.id){
                let timer=setTimeout(()=>{
                    this.backfun();
                    clearTimeout(timer);
                    this.time++;
                    timer=null;
                },2000)
            }else{
                this.loading2=false;
                this.$message({type: 'warning',showClose: true,'message':'回滚成功！'});
            }

        })
      }
    }
  
  }
</script>