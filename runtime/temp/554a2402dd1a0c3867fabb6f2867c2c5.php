<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/var/www/html/MyBlog/public/../application/admin/view/picture/admin-tuwanoperation.html";i:1554803810;}*/ ?>
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
<div style="width: 500px;margin: 20px auto;text-align: center;">
    <input type="text" placeholder="第几批数据" class="tuwan_a"><span>100条链接/批(前15批数据获取完毕)</span>
    <button type="button" class="btn btn-primary btn-block btn-lg" onclick="tuwan_a()" style="margin-top: 10px;">点击批量获取链接数据</button>
    <button type="button" class="btn btn-danger btn-block btn-lg" onclick="tuwan_del()" style="margin-top: 10px;">删除所有链接</button>
    <div class="tip_a"></div>
</div>
<div style="width: 300px;margin: 20px auto;text-align: center;">
    <input type="text" placeholder="第几批数据" class="tuwan_b"><span>100条链接/批</span>
    <button type="button" class="btn btn-primary btn-block btn-lg" onclick="tuwan_b()" style="margin-top: 10px;">点击筛选有效链接</button>
    <div class="tip_b"></div>
</div>
<div style="width: 300px;margin: 20px auto;text-align: center;">
    <input type="text" placeholder="第几批数据" class="tuwan_c"><span>100条链接/批</span>
    <button type="button" class="btn btn-primary btn-block btn-lg" onclick="tuwan_c()" style="margin-top: 10px;">点击获取完整数据</button>
    <div class="tip_c"></div>
</div>



</body>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/plugins/layer/layer.min.js"></script>
<script>

    function tuwan_a(){
        layer.load('添加中');
        var num = $(".tuwan_a").val();
        var html = "";
        $.ajax({
            url: '/admin/Picture/tuwan_a',
            dataType: 'json',
            type: 'post',
            data: { num: num },
            success: function (res) {
                layer.closeAll('loading');
                console.log(res);
                if(res.code=='1'){
                    html = "<p>获取第"+num+"批数据成功："+res.data+"</p>";
                    $('.tip_a').html(html);

                }
            },
        });
    }
    function tuwan_b(){
        layer.load('添加中');
        var page = $(".tuwan_b").val();
        var html = "";
        $.ajax({
            url: '/admin/Picture/tuwan_b',
            dataType: 'json',
            type: 'post',
            data: { page: page },
            success: function (res) {
                console.log(res);
                layer.closeAll('loading');
                if(res.code=='1'){
                    layer.msg(res.message);
                    html = "<p>修改第"+page+"批数据成功："+res.data+"</p>";
                    $('.tip_b').append(html);
                }
                if(res.code== '2'){
                    layer.msg(res.message);
                }
            },
        });
    }
    function tuwan_c(){
        layer.load('添加中');
        var page = $(".tuwan_c").val();
        var html = "";
        $.ajax({
            url: '/admin/Picture/tuwan_c',
            dataType: 'json',
            type: 'post',
            data: { page: page },
            success: function (res) {
                layer.closeAll('loading');
                console.log(res);
                layer.msg(res.message);
                if(res.code=='1'){
                    html = "<p>修改第"+page+"批数据成功："+res.data+"</p>";
                    $('.tip_c').append(html);
                }
            },
        });
    }
    function tuwan_del() {
        var str = "<div><h4>确定要删除全部数据吗？</h4></div>";
        layer.confirm(str, {btn: ['确定', '取消'], title: "提示"}, function () {
            layer.load();
            $.ajax({
                url: '/admin/Picture/tuwan_del',
                dataType: 'json',
                type: 'post',
                data: {},
                success: function (res) {
                    layer.closeAll('loading');
                    console.log(res);
                    layer.msg(res.message);
                },
            });
        });
    }

</script>
</html>