<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"/var/www/html/MyBlog/public/../application/admin/view/index/test.html";i:1554261322;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
</head>
<body>
    <button type="button" class="btn btn-primary btn-lg" onclick="status()">点击</button>
    <div class="tip"></div>
</body>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script>
    var page = 1;
    function status(){
        var html = "";
        $.ajax({
            url: '/admin/Index/test',
            dataType: 'json',
            type: 'post',
            data: { page: page },
            success: function (res) {
                console.log(res);
                // if(res.code=='1'){
                //     html = "<p>修改第"+page+"批数据成功："+res.data+"</p>";
                //     $('.tip').append(html);
                //     page++;
                // }
            },
        });
    }
</script>
</html>