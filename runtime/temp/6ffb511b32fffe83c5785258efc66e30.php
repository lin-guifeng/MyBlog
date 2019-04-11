<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/var/www/html/MyBlog/public/../application/index/view/index/tuwan.html";i:1554882212;}*/ ?>
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
    <style>
        .list{
            width: 270px;float: left;height: 320px;display: block;overflow: hidden;padding: 10px 10px;
        }
        .list img{
            width: 100%;overflow: hidden;
        }
    </style>
</head>
<body>
    <div style="width: 500px;margin: 20px auto;">
        <button type="button" class="btn btn-danger btn-block">下载</button>
    </div>
    <div style="width: 1080px;margin: 0 auto;overflow: hidden;" class="main">

    </div>
</body>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/plugins/layer/layer.min.js"></script>
<script>



    var page=1;
    var finished=0;
    var sover=0;
    var lastpage = 0;

    ajax_data(page);
    //页面滚动执行事件
    $(window).scroll(function (){
        loadmore($(this));
    });
    function ajax_data(num){
        var result = "";
        // layer.load('添加中');
        $.ajax({
            url: '/index/index/tuwan',
            dataType: 'json',
            type: 'post',
            data: { page: num },
            success: function (res) {
                console.log(res);
                if(res.code=='0'){
                    var data = res.data;
                    // layer.closeAll('loading');
                    // layer.msg(res.message);
                    for(var i = 0; i < 20; i++){
                        result+="<a href='<?php echo url("Index/tuwaninfo"); ?>?id="+data[i].id+"' class='list'><img src='"+data[i].pic.pic+"' alt=''></a>";
                    }
                    page++;
                    finished==0
                }else{
                    lastpage = 1;
                }
            },
        });
        setTimeout(function(){
            //$(".loadmore").remove();
            $('.main').append(result);

            finished=0;
            //最后一页
            if(lastpage==1)
            {
                sover=1;
                loadover();
            }
        },1000);
    }

    // //如果屏幕未到整屏自动加载下一页补满
    // var setdefult=setInterval(function (){
    //     if(sover==1)
    //         clearInterval(setdefult);
    //     else if($(".main").height()<$(window).height())
    //         loadmore($(window));
    //     else
    //         clearInterval(setdefult);
    // },500);

    //加载完
    function loadover(){
        if(sover==1){
            var overtext="Duang～到底了";
            $(".loadmore").remove();
            if($(".loadover").length>0){
                $(".loadover span").eq(0).html(overtext);
            }else{
                var txt='<div class="loadover"><span>'+overtext+'</span></div>'
                $("body").append(txt);
            }
        }
    }

    //加载更多
    function loadmore(obj){
        if(finished==0 && sover==0){
            var scrollTop = $(obj).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(obj).height();

            if($(".loadmore").length==0) {
                var txt='<div class="loadmore"><span class="loading"></span>加载中..</div>'
                $("body").append(txt);
            }

            if (scrollTop + windowHeight -scrollHeight<=50 ){
                //此处是滚动条到底部时候触发的事件，在这里写要加载的数据，或者是拉动滚动条的操作
                //防止未加载完再次执行
                finished=1;
                ajax_data(page);
            }
        }
    }


</script>
</html>