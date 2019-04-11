<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/var/www/html/MyBlog/public/../application/admin/view/picture/admin-picturelist.html";i:1554890167;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - Bootstrap Table</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<style>
    tr>td img{
        transition: All 0.4s ease-in-out;
        -webkit-transition: All 0.4s ease-in-out;
        -moz-transition: All 0.4s ease-in-out;
        -o-transition: All 0.4s ease-in-out;
    }
    tr>td img:hover{
        transform: scale(5);
        -webkit-transform: scale(5);
        -moz-transform: scale(5);
        -o-transform: scale(5);
        -ms-transform: scale(5);
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <!-- Example Pagination -->
                    <div class="example-wrap">
                        <div class="example">
                            <form id="formSearch" class="form-horizontal">
                                <div class="form-group" style="margin-top:15px">
                                    <label class="control-label col-sm-1" for="keyword">关键词</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="keyword">
                                    </div>

                                    <div class="col-sm-4" style="text-align:left;">
                                        <button type="button" style="margin-left:50px" id="btn_query" class="btn btn-primary search_btn">查询</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Example Pagination -->
                </div>
            </div>
        </div>
    </div>
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <!-- Example Pagination -->
                    <div class="example-wrap">
                        <div class="example">
                            <div role="group" id="toolbar">
                                <button id="btn_add" type="button" class="btn btn-outline btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <span>导入</span>
                                </button>
                                <button id="btn_edit" type="button" class="btn btn-outline btn-primary">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    <span>保存</span>
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
<script src="/static/admin/js/plugins/layer/layer.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
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
                url: '<?php echo url("Picture/pictureData"); ?>', //请求地址
                method: 'GET', //请求
                toolbar: '#toolbar',
                striped: true,
                cache: false,
                pagination: true,
                sortable: true,
                clickToSelect: true,
                search: true,
                sidePagination: "server", //客户端client   服务端server
                pageNumber: 1,
                pageSize: 10,
                uniqueId: "id",
                queryParams: oTableInit.queryParams,
                // queryParams: function (params) {
                //     return {
                //         offset: params.offset,  //页码
                //         limit: params.limit,   //页面大小
                //     };
                // },
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
                    field: 'keyword',
                    title: '关键词',
                    align: 'center',
                    valign: 'middle',
                }, {
                    field: 'url',
                    title: '图片',
                    align: 'center',
                    valign: 'middle',
                    formatter : function (value, row, index) {
                        return "<img style='height: 50px;' src='"+value+"' alt=''>"
                    },
                }, {
                    field: 'time',
                    title: '添加时间',
                    align: 'center',
                    valign: 'middle',
                }],

            });
        };
        oTableInit.queryParams = function (params) {
            var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
                limit: params.limit,   //页面大小
                offset: params.offset,  //页码
                keyword: $("#keyword").val(),
                // statu: $("#txt_search_statu").val()
            };
            return temp;
        };
        return oTableInit;
    };

    window.operateEvents = {
        "click #tableBtn": function (e, value, row, index) {
            status(row.id);
        }
    }
    $('.search_btn').click(function() {
        $('#table').bootstrapTable('refresh', {
            url : '<?php echo url("Picture/pictureData"); ?>'
        });
    })
    function status(obj){
        $.ajax({
            url: '/admin/Picture/lunboStatus',
            dataType: 'json',
            type: 'get',
            data: { id: obj },
            success: function (res) {
                console.log(res);
                if(res.code=='1'){
                    $("#table").bootstrapTable("refresh", {
                        silent: true //静态刷新
                    });
                }
            },
        });
    }

    $("#btn_add").click(function () {
        layer.open({
            type: 2,
            title: '导入',
            area: ['800px', '90%'],
            content: '<?php echo url("Picture/pictureAdd"); ?>'
        });
    })
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
                // alert("获取选中的id为" + id);
                layer.open({
                    type: 2,
                    title: '添加分组',
                    area: ['800px', '90%'],
                    content: '<?php echo url("Picture/lunboEdit"); ?>?id='+id,
                });
            } else {
                alert("请选中要编辑的数据");
            }
        }
    })
    $("#btn_delete").click(function () {
        if (confirm("确认要删除吗？")) {
            layer.load('删除中');
            var idlist = "";
            $("input[name='btSelectItem']:checked").each(function () {
                idlist += $(this).parents("tr").attr("data-uniqueid") + ",";
            })
            console.log(idlist);
            $.ajax({
                url: '/admin/Picture/pictureDel',
                dataType: 'json',
                type: 'get',
                data: { idlist: idlist },
                success: function (res) {
                    console.log(res);
                    layer.closeAll('loading');
                    if(res.code=='1'){
                        self.location.reload();
                    }
                },
            });
        }
    });
</script>
</body>
</html>
