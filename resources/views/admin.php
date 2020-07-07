<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理界面</title>
    <link href="https://cdn.bootcdn.net/ajax/libs/element-ui/2.13.2/theme-chalk/index.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <h5>捐书记录管理（审核）</h5>
        <el-table
            :data="orders"
            style="width: 100%">

            <el-table-column
                label="#"
                width="30"
                prop="id"
            ></el-table-column>

            <el-table-column
                label="姓名"
                width="100"
                prop="name"
            ></el-table-column>

            <el-table-column
                label="捐书数量"
                width="80"
                prop="count"
            ></el-table-column>

            <el-table-column
                label="电子邮箱"
                width="100"
                prop="email"
            ></el-table-column>

            <el-table-column
                label="提交时间"
                width="180"
                prop="created_at"
            >
            </el-table-column>

            <el-table-column
                label="提交状态"
                width="220">
                <template slot-scope="scope">
                    {{ getStatus(scope.row.status) }}
                </template>
            </el-table-column>
            <el-table-column label="操作" width="300">
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="checkIt(1, scope.row.id,scope.$index)">审核并发送邮件</el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="checkIt(-1, scope.row.id,scope.$index)">不通过</el-button>
                </template>
            </el-table-column>
        </el-table>


    <div class="pagination">
        <el-pagination
            background
            layout="prev, pager, next"
            :total="total"
            @current-change="handleCurrentPageChange"
            :current-page="currentPage"
            :page-size="10"
        >
        </el-pagination>
    </div>
</div>
<script src="/js/vue.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/element-ui/2.13.2/index.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            "orders" : [],
            currentPage:1,
            total:1,
        },
        methods: {
            loadOrder() {
                axios.get("/orders?page="+this.currentPage).then(res=>{
                    console.log(res)
                    this.orders = res.data.data
                    this.total = res.data.meta.total
                })
                return false;
            },
            handleCurrentPageChange(val)
            {
                this.currentPage = val
                this.loadOrder()
            },
            getStatus(state)
            {
              switch (state) {
                  case 1:
                       return  "已通过审核，并已发送邮件"
                  case -1:
                      return "未通过审核"
                  case 0:
                      return "待审核"
                  case 8:
                      return "邮件正在发送中，请稍等"
              }
            },
            checkIt(type,id,index)
            {
                this.orders[index]['status'] = 8
                axios.post("/order/check/"+id,{
                    'type':type
                }).then(res=>{
                    this.orders[index]['status'] = res.data.status
            })
            }
        },
        mounted()
        {
            if (!sessionStorage.getItem("isLogin")){
                if (prompt("请输入密码") != "adminyiban"){
                    return location.href ="/"
                }else {
                    sessionStorage.setItem("isLogin",true)
                }
            }

            this.loadOrder()
        }
    });
</script>

</body>
</html>
