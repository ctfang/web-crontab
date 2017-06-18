<template>
    <div>
        
        <el-row style="margin-top:30px;text-align:center">
            <el-row>
                    <el-col :span='12'>
                        <el-button>{{this.formdate(this.beforeTime)}}</el-button>
                    </el-col>
                    <el-col :span='12'>
                        <el-button>{{this.formdate(this.lastTime)}}</el-button>
                    </el-col>
            </el-row>
            <h3>启动完成</h3>
            <router-link to="/index/plan_list"><el-button type="primary">返回方案列表</el-button></router-link>
        </el-row>
    </div>
</template>

<script>
  export default {
    props:['beforeTime','lastTime'],
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
        formdate(time){
            console.log(typeof time)
            if(typeof time=='string'||typeof time=='number'){
                time = new Date(time*1000);
                return time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
            }else{
                return '';
            }
            
        }
    }
  }
</script>