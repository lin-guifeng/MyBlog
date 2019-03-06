<?php
namespace app\index\controller;

class Common
{
    public function getHtmls(){
        //搜索指定关键词的百度图片并显示
        $keyword = "美女";
        $keyword = urlencode($keyword);
        $url = "http://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=".$keyword."&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=&z=&ic=&hd=&latest=&copyright=&word=".$keyword."&s=&se=&tab=&width=&height=&face=&istype=&qc=&nc=&fr=&expermode=&force=&pn=30&rn=30&gsm=1e&1551863311988=";
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