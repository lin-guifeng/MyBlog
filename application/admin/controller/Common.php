<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\Session;
class Common extends Controller
{
    public function _initialize()
    {
        if(session('admin_id')==NULL){
            $this->error('请先登录','admin/login/login');
        }
        if(session('long_time')+36000<time()){
            session('admin_id',NULL);
            session('admin_name',null);
            $this->error('登录超时,请重新登录','admin/login/login');
        }else{
            session('long_time',time());
        }
    }
    public function getHtml(){
        //搜索指定关键词的百度图片并显示
        $keyword = "美女";
        $keyword = urlencode($keyword);
        $url = "https://image.baidu.com/search/index?tn=baiduimage&ipn=r&ct=201326592&cl=2&lm=-1&st=-1&fm=index&fr=&hs=0&xthttps=111111&sf=1&fmq=&pv=&ic=0&nc=1&z=&se=1&showtab=0&fb=0&width=&height=&face=0&istype=2&ie=utf-8&word=%E7%BE%8E%E5%A5%B3&oq=meinv&rsp=0";
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);
        dump($text);
    }
    public function paqu(){
        //搜索指定关键词的百度图片并显示
        $keyword = "风景";
        $keyword = urlencode($keyword);
        $url = "http://image.baidu.com/search/index?tn=baiduimage&word=" . $keyword;
        $html = file_get_contents($url);
        preg_match_all("/\"[^\"]*[^0]\.jpg\"/", $html, $text);
        dump($text);
//        foreach ($text as $key => $value) {
//            foreach ($value as $img) {
//                print "<img src=" . $img . " style='width:30px;'/>";
//            }
//        }


    }
    public function get1(){
        $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=%E9%A3%8E%E6%99%AF&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=%E9%A3%8E%E6%99%AF&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=30&rn=30&gsm=1e&1553046679244=";
        $html = file_get_contents($url);
        dump($html);
    }
    public function get2(){
        $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=%E9%A3%8E%E6%99%AF&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=%E9%A3%8E%E6%99%AF&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=60&rn=30&gsm=3c&1553046679306=";
        $html = file_get_contents($url);
        dump($html);
    }
    public function get3(){
        $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=%E9%A3%8E%E6%99%AF&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=%E9%A3%8E%E6%99%AF&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=90&rn=30&gsm=5a&1553046735808=";
        $html = file_get_contents($url);
        dump($html);
    }
    public function get4(){
        $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=%E9%A3%8E%E6%99%AF&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=%E9%A3%8E%E6%99%AF&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=120&rn=30&gsm=78&1553046735861=";
        $html = file_get_contents($url);
        $html = json_decode($html,true);
        dump($html);
    }
    public function getall(){
        $keyword = "美女";
        $keyword = urlencode($keyword);
        $pn = 30;
        $gsm = base_convert($pn, 10, 16);
//        for ($i=1;$i<=100;$i++){
//
//        }
        $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=".$keyword."&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=".$keyword."&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=".$pn."&rn=30&gsm=".$gsm;


        $html = file_get_contents($url);
        $html = json_decode($html,true);
        dump($html['data']);
    }

    public function getPicture($keyword,$num){
        $keywords = urlencode($keyword);

        $html = [];
        $t1=microtime(true);

        for ($i=0;$i<$num;$i++){
            $pn = 30+30*$i;
            $gsm = base_convert($pn, 10, 16);
            $url = "https://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&is=&fp=result&queryWord=".$keywords."&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=-1&z=&ic=&hd=&latest=&copyright=&word=".$keywords."&s=&se=&tab=&width=&height=&face=0&istype=2&qc=&nc=1&fr=&expermode=&force=&pn=".$pn."&rn=30&gsm=".$gsm;
            $con = file_get_contents($url);
            $con = json_decode($con,true);
            $html = array_merge((array)$html,(array)$con['data']);
            if($con['data']['0']){
                break;
            }
        }
        $t2=microtime(true);
        foreach($html as $key=>$value){
//            $res[$key]['url'] = $value['middleURL'];
//            $res[$key]['title'] = $value['fromPageTitleEnc'];
//            $res[$key]['keyword'] = $keyword;
            foreach ($value as $keys=>$val){
                if($keys=='middleURL'){
                    $res[$key]['url'] = $value[$keys];
                }
                if($keys=='fromPageTitleEnc'){
                    $res[$key]['title'] = $value[$keys];
                }
                $res[$key]['keyword'] = $keyword;
            }
        }
        $t3=microtime(true);
        $time1=$t2-$t1;
        $time2=$t3-$t2;
        $res = $time1.'.'.$time2;
        return $res;
    }

}
?>