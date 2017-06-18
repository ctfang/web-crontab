<template>
    <div>
        <div style="display:flex;justify-content:center;margin-top:30px;height:80px;" v-loading="loading2"
    element-loading-text="重启中">

        </div>
        <el-row style="margin-top:30px;text-align:center">
            <router-link to="/index/add_plan"><el-button type="primary">取消</el-button></router-link>
        </el-row>
    </div>
</template>

<script>
  export default {
	props:['beforeId','beforeTime'],
    data() {
        return {
            loading2: true,
            time:0,
        }
    },
    created(){
        this.getVersion();
    },
    methods: {
        getVersion(){
            http.post('/cron/restart/info')
            .then((res)=>{
                if(this.time>=60){
                    this.$message({type: 'warning',showClose: true,'message':'请求超时，请刷新页面！'});
                    return false;
                }
                if(res.data.arrData.last_id==this.beforeId){
                    let timer=setTimeout(()=>{
                        this.getVersion();
                        clearTimeout(timer);
                        this.time++;
                        timer=null;
                    },2000)
                }else{
                    this.$emit('selectOption', 4 ,false,res.data.arrData);
                }

            })
        }
    }
  }
</script>