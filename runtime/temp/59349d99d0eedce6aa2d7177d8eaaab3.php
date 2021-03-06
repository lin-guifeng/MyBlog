<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/var/www/html/MyBlog/public/../application/admin/view/article/admin-articleedit.html";i:1553652388;}*/ ?>
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
    <!--<link href="/static/admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">-->
</head>
<style>
    .modal-backdrop{
        z-index: -1!important;
        opacity: 0!important;
    }
</style>
<body class="gray-bg">
<div style="width: 100%;height: 20px;"></div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="form1" action="<?php echo url('article/articleEdit'); ?>?id=<?php echo $article['id']; ?>" method="post" target="_parent">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">封面</label>
                            <div class="col-sm-4">
                                <div style="height: 100px;">
                                    <input name="image" type="file" onchange="change(this)" class="upload_input" style="display: none;" id="myfile" >
                                    <input type="hidden" name="img" value="<?php echo $article['img']; ?>" class="imginput">
                                    <img src="<?php echo $article['img']; ?>" alt="" style="height: 100%;" onclick="clickImg(this)" class="showImg">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="title" required value="<?php echo $article['title']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="introduction" required value="<?php echo $article['introduction']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章详情</label>
                            <div class="col-sm-8">
                                <div class="ibox no-padding" style="border: solid 1px #e5e6e7;height: 400px;">
                                    <div name="txt" id="summernote"><?php echo $article['content']; ?></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="txt" id="details">
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" onclick="check()">提交</button>
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
<!-- SUMMERNOTE -->
<!--<script src="/static/admin/js/plugins/summernote/summernote.min.js"></script>-->
<script type="text/javascript" src="/static/admin/js/plugins/summernote/summernote-bs4.js"></script>
<script src="/static/admin/js/plugins/summernote/summernote-zh-CN.js"></script>
<script>
    function clickImg(obj){
        $(obj).parent().find('.upload_input').click();
    }
    function change(obj){
        var formdata = new FormData();
        formdata.append("file", document.getElementById('myfile').files[0]);
        console.log(formdata.get("file"));
        $.ajax({
            type:"post",
            url:"/admin/Index/uppic",
            data:formdata,
            dataType: "json",
            cache: false,//不缓存
            contentType:false,
            processData:false,
            success:function(res){
                $('.imginput').val(res);
                $('.showImg').attr("src",res);
            },
            error: function(jqXHR){
                alert("发生错误：" + jqXHR.status);
            },
        });
    }
    $(document).ready(function () {
        $('#summernote').summernote({
            lang: 'zh-CN',
            height: 300,
            focus:true,
            dialogsFade : true,
            dialogsInBody : true,
            disableDragAndDrop : false,
            callbacks: {
                onImageUpload: function (files) {
                    var formdata = new FormData();
                    formdata.append("file", files[0]);
                    $.ajax({
                        url: '/admin/Index/uppic',//上传图片文件处理地址,
                        type: "POST",
                        data: formdata,
                        dataType: 'JSON',
                        processData: false,//告诉jQuery不要加工数据
                        contentType: false,
                        success: function (data) {
                            $('#summernote').summernote('insertImage', data, 'img');
                        },
                        error: function (data) {
                            alert('图片上传出错，文件过大或者其他情况');
                        }
                    });
                }
            }
        });
    });
    function check() {
        var a = $('#summernote').summernote('code');
        $('#details').val(a);
        document.getElementById('form1').submit();
    }
</script>
</body>
</html>
