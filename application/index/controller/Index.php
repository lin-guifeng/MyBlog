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


        foreach ($data as &$value){
            $value['content'] = mb_substr ( $value['content'], 0,100,'utf-8' );
        }

        dump($data);
        exit;
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
