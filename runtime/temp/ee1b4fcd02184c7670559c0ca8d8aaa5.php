<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/var/www/html/MyBlog/public/../application/index/view/index/tuwaninfo.html";i:1554806337;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/swiper-4.5.0/dist/css/swiper.min.css">
    <script src="/static/swiper-4.5.0/dist/js/swiper.min.js"></script>
    <style>
        html, body {
            position: relative;
            height: 100%;
        }
        body {
            background: #000;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color:#000;
            margin: 0;
            padding: 0;
        }
        .swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }
        .swiper-slide {
            background-size: cover;
            background-position: center;
            text-align: center;
        }
        .gallery-top {
            height: 80%;
            width: 100%;
        }
        .gallery-thumbs {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }
        .gallery-thumbs .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }
        .gallery-thumbs .swiper-slide-thumb-active {
            opacity: 1;
        }
    </style>
</head>
<body>
<!-- Swiper -->
<div class="swiper-container gallery-top">
    <div class="swiper-wrapper">
        <?php if(is_array($data['details']) || $data['details'] instanceof \think\Collection || $data['details'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['details'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="swiper-slide" style=""><img src="<?php echo $vo; ?>" alt=""></div>
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/2)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/3)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/4)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/5)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/6)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/7)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/8)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/9)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/10)"></div>-->
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
</div>
<div class="swiper-container gallery-thumbs">
    <div class="swiper-wrapper">
        <?php if(is_array($data['thumb']) || $data['thumb'] instanceof \think\Collection || $data['thumb'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['thumb'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="swiper-slide"><img src="<?php echo $vo; ?>" alt=""></div>
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/2)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/3)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/4)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/5)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/6)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/7)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/8)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/9)"></div>-->
        <!--<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/10)"></div>-->
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!-- Swiper JS -->
<script src="/static/swiper-4.5.0/dist/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });
</script>
</body>
</html>