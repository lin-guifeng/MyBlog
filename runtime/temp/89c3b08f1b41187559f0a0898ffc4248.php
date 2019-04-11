<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/var/www/html/MyBlog/public/../application/index/view/index/index1.html";i:1553595791;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/swiper-4.5.0/dist/css/swiper.min.css">
    <script src="/static/swiper-4.5.0/dist/js/swiper.min.js"></script>
<style>
    * { margin: 0; padding: 0 }
    body { font: 15px "Microsoft YaHei", Arial, Helvetica, sans-serif; color: #333; background: #E9EAED; line-height: 1.5; overflow-x: hidden; }
    img { border: 0; display: block }
    ul, li { list-style: none; }
    a { text-decoration: none; color: #333; }
    a:hover { color: #000; text-decoration: none; }
    .clear { clear: both; width: 100%; overflow: hidden; height: 20px }
    .clearblank { clear: both; width: 100%; overflow: hidden; }
    .fl { float: left!important; }
    .fr { float: right!important; }
    .box, article { width: 1200px; margin: auto; overflow: hidden }
    .navbox { width: 1200px; margin: auto; }
    .mt20 { margin-top: 20px; }
    .blue { color: #00C1DE }
    header{
        width: 100%;
        padding: 5px 0;
        background: #1C2327;
        height: 50px;
        margin-bottom: 20px;
    }
    header::before {
        background: #000 linear-gradient(to left, #4cd964, #5ac8fa, #007aff, #34aadc, #5856d6, #ff2d55);
        content: "";
        height: 5px;
        position: absolute;
        top: 0;
        width: 100%;
    }
    .navbox{
        width: 1200px;
        marign: 0 auto;
        position: relative;
    }
    .logo {
        float: left;
        margin-right: 60px;
        line-height: 50px;
        color: #FFF;
        font-size: 22px;
    }
    nav {
        float: left;
        height: 50px;
        line-height: 50px;
        text-align: center;
    }
    #starlist li {
        position: relative;
        display: inline;
        float: left;
        width: max-content;
    }
    #starlist li a:hover, #starlist #selected, .selected > a, #starlist li:hover {
        color: #00c1de;
    }
    #starlist li a {
        display: inline;
        float: left;
        padding: 0 20px;
        color: #fff;
    }
    .lbox {
        width: 75%;
        float: left;
        overflow: hidden;
    }
    .rbox {
        width: 23.5%;
        float: right;
        overflow: hidden;
    }
    .banbox {
        width: 100%;
        overflow: hidden;
        float: left;
        border-radius: 3px;
        margin-bottom: 20px;
    }
    .swiper-container {
        width: 100%;
        height: 500px;
    }
    .swiper-slide {
        overflow: hidden;
    }
    .box1{
        overflow: hidden;
        margin-bottom: 20px;
        padding: 20px;
        background: #FFF;
        -webkit-box-shadow: 0 2px 5px 0 rgba(146, 146, 146, .1);
        -moz-box-shadow: 0 2px 5px 0 rgba(146, 146, 146, .1);
        box-shadow: 0 2px 5px 0 rgba(146, 146, 146, .1);
        -webkit-transition: all 0.6s ease;
        -moz-transition: all 0.6s ease;
        -o-transition: all 0.6s ease;
        transition: all 0.6s ease;
        position: relative;
    }
    .box1 h3{
        margin: 0 0 10px 0;
        font-size: 18px;
        overflow: hidden;
    }
    .box1 .newsl{
        float: left;
        width: 30%;
        max-height: 150px;

        display:flex;
        align-items:center;
        justify-content:center;
        overflow: hidden;
    }
    .box1 .newsl img{
        width: 100%;
        height:auto;
        -moz-transition: all .5s ease;
        -webkit-transition: all .5s ease;
        -ms-transition: all .5s ease;
        -o-transition: all .5s ease;
        transition: all .5s ease;
        transition: all 0.5s;
    }
    .box1 .newsr{
        float: left;
        width: 70%;
        display: block;
        overflow: hidden;
        padding-left: 20px;
        /*border-radius: 3px;*/
        /*position: relative;*/
    }
    .boxlink{
        display: block;
        padding: 3px 10px;
        background: #12b7de;
        color: #fff;
        border-radius: 3px;
    }
</style>
</head>
<body>
    <header>
        <div class="navbox">
            <!--<h2 id="mnavh"><span class="navicon"></span></h2>-->
            <div class="logo"><a href="http://www.linguifeng.top">林桂锋个人博客</a></div>
            <nav>
                <ul id="starlist">
                    <li><a href="<?php echo url('index/index'); ?>">首页</a></li>
                    <li><a href="<?php echo url('index/skill-list'); ?>">技术</a></li>
                    <li><a href="<?php echo url('index/diary-list'); ?>">随笔</a></li>
                    <li><a href="<?php echo url('index/album'); ?>">相册</a></li>
                </ul>
            </nav>
            <div class="searchico"></div>
        </div>
    </header>
    <div class="clearblank"></div>
    <article>
        <div class="lbox">
            <div class="banbox">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                    <?php if(is_array($lunbo) || $lunbo instanceof \think\Collection || $lunbo instanceof \think\Paginator): $i = 0; $__LIST__ = $lunbo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="swiper-slide"><a href="/" target="_blank"><img src="<?php echo $vo['url']; ?>" style="width:100%;"></a></div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <!-- 如果需要分页器 -->
                    <div class="swiper-pagination"></div>

                    <!-- 如果需要导航按钮 -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="list">
                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="box1" style="background-color: #fff;height: 220px;">
                    <h3>个人博客，属于我的小世界！</h3>
                    <div class="newsl">
                        <img src="<?php echo $vo['img']; ?>" alt="">
                    </div>
                    <div class="newsr">
                        <div style="height: 120px;">
                            <?php echo $vo['con']; ?>
                        </div>
                        <div style="height: 30px;line-height: 30px;">
                            <ul>
                                <li style="float: left;margin: 0 15px 0 0;color: #748594;font-size: 12px;">
                                    <i class="fa fa-user"></i>
                                    <span>林桂锋</span>
                                </li>
                                <li style="float: left;margin: 0 15px 0 0;color: #748594;font-size: 12px;">
                                    <i class="fa fa-clock-o"></i>
                                    <span>2018-5-13</span>
                                </li>
                                <li style="float: left;margin: 0 15px 0 0;color: #748594;font-size: 12px;">
                                    <i class="fa fa-eye"></i>
                                    <span>34567已阅读</span>
                                </li>
                                <li style="float: left;margin: 0 15px 0 0;color: #748594;font-size: 12px;">
                                    <i class="fa fa-heart-o"></i>
                                    <span>9999</span>
                                </li>
                                <!--<li style="float: left;margin: 0 15px 0 0;color: #748594;font-size: 12px;">-->
                                    <!--<i class="fa fa-list"></i>-->
                                    <!--<span>林桂锋</span>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="rbox">

        </div>
    </article>

</body>
<script>
    var mySwiper = new Swiper ('.swiper-container', {
        loop: true, // 循环模式选项
        autoplay: true,
        width: 900,
        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },

        // 如果需要前进后退按钮
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    })
</script>
</html>