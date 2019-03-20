<?php
namespace app\admin\controller;

class Usertype extends Common
{
    public function paqu(){

        //搜索指定关键词的百度图片并显示
        $keyword = "风景";
        $keyword = urlencode($keyword);
        $url = "http://image.baidu.com/search/index?tn=baiduimage&word=" . $keyword;
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);
        foreach ($text as $key => $value) {
            foreach ($value as $img) {
                print "<img src=" . $img . " style='width:30px;'/>";
            }
        }


    }
}