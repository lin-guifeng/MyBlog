<?php
namespace app\index\controller;
use \think\Controller;
class Index extends Controller
{
    public function index(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();
        $data = model('index')->getList();





        $this->assign('data',$data);
        $this->assign('user',$user);
        $this->assign('lunbo',$lunbo);
        return view('index');
    }
    public function index1(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();
        $data = model('index')->getList();





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
