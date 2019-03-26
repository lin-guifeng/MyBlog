<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/var/www/html/MyBlog/public/../application/index/view/index/index1.html";i:1553578709;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/swiper-4.5.0/dist/css/swiper.min.css">
    <script src="/static/swiper-4.5.0/dist/js/swiper.min.js"></script>
<style>
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
    <article>
        <div class="lbox">
            <div class="banbox">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">Slide 1</div>
                        <div class="swiper-slide">Slide 2</div>
                        <div class="swiper-slide">Slide 3</div>
                    </div>
                    <!-- 如果需要分页器 -->
                    <div class="swiper-pagination"></div>

                    <!-- 如果需要导航按钮 -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
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