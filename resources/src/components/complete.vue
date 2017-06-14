<template>
    <div>
        
        <el-row style="margin-top:30px;text-align:center">
            <el-row>
                    <el-col :span='12'>
                        <el-button>2017-05-05</el-button>
                    </el-col>
                    <el-col :span='12'>
                        <el-button>2017-05-06</el-button>
                    </el-col>
            </el-row>
            <h3>启动完成</h3>
            <router-link to="/index/plan_list"><el-button type="primary">返回方案列表</el-button></router-link>
        </el-row>
    </div>
</template>

<script>
  export default {
    data() {
        return {
 
        }
    },
    created(){
        http.post('/cron/restart/info')
        .then((res)=>{
            console.log(res)
        })
    },
    methods: {

    }
  }
</script>