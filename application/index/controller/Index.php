<?php
namespace app\index\controller;
use \think\Controller;
class Index extends Controller
{
    public function index(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();
        $data = model('index')->getList();


        foreach ($data as &$value){
            $value['con'] = mb_substr ( $value['content'], 0,100,'utf-8' );
        }

//        dump($data);
//        exit;


        $this->assign('data',$data);
        $this->assign('user',$user);
        $this->assign('lunbo',$lunbo);
        return view('index');
    }
    public function index1(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();
        $data = model('index')->getList();
        foreach ($data as &$value){
            $content_01 = $value["content"];//从数据库获取富文本content
            $content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
            $content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
            $contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
            $value['con'] = mb_substr ( $contents, 0,100,'utf-8' );
        }
        $this->assign('data',$data);
        $this->assign('user',$user);
        $this->assign('lunbo',$lunbo);
        return view('index1');
    }
    public function phpinfo(){
        echo phpinfo();
    }
    public function lists(){
        return view('list');
    }
    public function info(){
        $id = input(get.id);
        $data = model('index')->getinfo($id);
        $this->assign('data',$data);
        return view('info');
    }
    public function list2(){
        return view('list2');
    }
    public function list3(){
        return view('list3');
    }
    public function time(){
        return view('time');
    }
    public function about(){
        return view('about');
    }
    public function daohang(){
        return view('daohang');
    }


}
