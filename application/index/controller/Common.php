<?php
namespace app\index\controller;

class Common
{
    function getImg($url, $u_id){

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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://image.baidu.com/search/index?tn=baiduimage&ct=201326592&lm=-1&cl=2&ie=gb18030&word=%CD%BC%C6%AC&fr=ala&ala=1&alatpl=others&pos=0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $html = curl_exec($ch);
        curl_close($ch);
        var_dump($html);
    }
}