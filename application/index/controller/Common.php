<?php
namespace app\index\controller;

class Common
{
    public function getHtmls(){
        //搜索指定关键词的百度图片并显示
        $keyword = "美女";
        $keyword = urlencode($keyword);
        $url = "https://image.baidu.com/search/index?tn=baiduimage&ipn=r&ct=201326592&cl=2&lm=-1&st=-1&fm=index&fr=&hs=0&xthttps=111111&sf=1&fmq=&pv=&ic=0&nc=1&z=&se=1&showtab=0&fb=0&width=&height=&face=0&istype=2&ie=utf-8&word=%E7%BE%8E%E5%A5%B3&oq=meinv&rsp=0";
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);

        dump($text);
    }
    public function getImg($url, $u_id){

        if (file_exists('./images/' . $u_id . ".jpg")) {
            return "images/$u_id" . '.jpg';
        }
        if (empty($url)) {
            return '';
        }
        $context_options = array(
            'http' => array(
                    'header' => "Referer:http://www.zhihu.com"//带上referer参数
            ),
        );
        $context = stream_context_create($context_options);
        $img = file_get_contents('http:' . $url, FALSE, $context);
        file_put_contents('./images/' . $u_id . ".jpg", $img);
        return "images/$u_id" . '.jpg';
    }
    public function getHtml(){

     
        //搜索指定关键词的百度图片并显示
        $keyword = "美女";
        $keyword = urlencode($keyword);
        $url = "http://image.baidu.com/search/index?tn=baiduimage&word=" . $keyword;
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);
        foreach ($text as $key => $value) {
            foreach ($value as $img) {
                print "<img src=" . $img . " style='width:100px;'/>";
            }
        }
        echo count($text);



    }
}