<?php
namespace app\index\controller;

class Common
{
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