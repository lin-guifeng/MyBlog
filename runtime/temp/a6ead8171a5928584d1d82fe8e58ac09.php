<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/var/www/html/MyBlog/public/../application/admin/view/account/admin-record.html";i:1553046519;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - Bootstrap Table</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<style>
    .warning{background-color: #666;}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">

    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <!-- Example Pagination -->
                    <div class="example-wrap">
                        <div class="example">
                            <div class="" role="group" id="toolbar">
                                <button type="button" class="export-excel btn btn-outline btn-primary">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>数据导出</span>
                                </button>
                                <button id="btn_delete" type="button" class="btn btn-outline btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    <span>删除</span>
                                </button>
                            </div>

                            <table id="table"></table>
                        </div>
                    </div>
                    <!-- End Example Pagination -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Panel Other -->
</div>

<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>

<!-- Bootstrap table -->
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="/static/admin/js/FileSaver.js"></script>
<script src="/static/admin/js/tableexport.min.js"></script>

<script>
    $(function () {
        //1.初始化Table
        var oTable = new TableInit();
        oTable.Init();
    });
    var TableInit = function () {
        var oTableInit = new Object();
        oTableInit.Init = function () {
            $('#table').bootstrapTable({
                url: '<?php echo url("Account/recordData"); ?>', //请求地址
                method: 'GET', //请求
                toolbar: '#toolbar',
                striped: true,
                cache: false,
                pagination: true,
                sortable: true,
                clickToSelect: true,
                search: false,
                sidePagination: "server", //客户端client   服务端server
                pageNumber: 1,
                pageSize: 10,
                uniqueId: "id",

                // pageList: [10, 15],
                queryParams: function (params) {
                    return {
                        offset: params.offset,  //页码
                        limit: params.limit,   //页面大小
                    };
                },
                showHeader : true,
                showColumns : true,
                showRefresh : true,
                columns: [{
                    checkbox: true,
                }, {
                    field: 'id',
                    title: 'ID',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'aid',
                    title: '用户ID',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'name',
                    title: '用户昵称',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'user',
                    title: '登录账号',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'groups',
                    title: '所属分组',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'time',
                    title: '最后登录时间',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'area',
                    title: '登录地区',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'ip',
                    title: '登录ip',
                    align: 'center',
                    valign: 'middle',
                }],
                showExport: true,
                exportDataType: "basic",
                exportTypes:['excel','xlsx'],
            });
        };
        return oTableInit;
    };
    $(".export-excel").click(function () {
        //导出
        $("#table").tableExport({
            type: "excel",
            escape: "false",
            fileName: '答题情况表'
        });
    });

    // function editMemberInfoShow() {
        // $('#table').tableExport({ type: 'excel', escape: 'false' });
    // }
    $("#btn_edit").click(function () {
        var i = 0;
        var id;
        $("input[name='btSelectItem']:checked").each(function () {
            i++;
            id = $(this).parents("tr").attr("data-uniqueid");
        })
        if (i > 1) {
            alert("编辑只支持单一操作")
        } else {
            if (i != 0) {
                alert("获取选中的id为" + id);
                // window.location.href = "/index/index";
            } else {
                alert("请选中要编辑的数据");
            }
        }
    })
    $("#btn_delete").click(function () {
        if (confirm("确认要删除吗？")) {
            var idlist = "";
            $("input[name='btSelectItem']:checked").each(function () {
                idlist += $(this).parents("tr").attr("data-uniqueid") + ",";
            })
            $.ajax({
                url: '/admin/account/recordDel',
                dataType: 'json',
                type: 'get',
                data: { idlist: idlist },
                success: function (res) {
                    console.log(res);
                    if(res.code=='1'){
                        self.location.reload();
                    }
                },
            });
            // alert("删除的列表为" + idlist);
        }
    });

</script>
</body>
</html>
