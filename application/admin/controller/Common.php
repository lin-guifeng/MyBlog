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

}
?>