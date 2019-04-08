<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"/var/www/html/MyBlog/public/../application/admin/view/picture/admin-tuwanadd.html";i:1553736973;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/css/plugins/summernote/summernote-bs4.css">
    <link href="/static/css/webuploader.css" rel="stylesheet" type="text/css">
</head>
<style>

</style>
<body class="gray-bg">
<div style="width: 100%;height: 20px;"></div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="form1" action="<?php echo url('picture/tuwanAdd'); ?>" method="post">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">关键词</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="keyword">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">导入数据量</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="num">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
<script src="/static/admin/js/plugins/layer/layer.min.js"></script>
<script>
    // $('.btn').click(function (e){
    //     layer.load('添加中');
    //     // var index = layer.load(0, {shade: false});
    //     $.ajax({
    //         type: "POST",//方法类型
    //         dataType: "json",//预期服务器返回的数据类型
    //         url: "<?php echo url('picture/tuwanAdd'); ?>" ,//url
    //         data: $('#form1').serialize(),
    //         success: function (res) {
    //             layer.closeAll('loading');
    //             console.log(res);
    //             if(res.code=='1'){
    //                 parent.location="<?php echo url('picture/tuwanList'); ?>";
    //             }
    //         },
    //         error : function(res) {
    //             console.log(res);
    //             layer.closeAll('loading');
    //             layer.msg("数据异常！");
    //         }
    //     });
    // })
</script>
</body>
</html>
