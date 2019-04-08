<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/var/www/html/MyBlog/public/../application/index/view/index/tuwan.html";i:1553768875;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="width: 1000px;margin: 0 auto;background-color: #2A2E36;">
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <a style="width: 250px;float: left;height: 300px;margin: 10px 0;display: block;" href="<?php echo url("","",true,false);?>?id=<?php echo $vo['id']; ?>">
            <img src="<?php echo $vo['pic']; ?>" alt="" style="width: 100%;overflow: hidden;">
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</body>
</html>