<?php
namespace app\index\controller;
use \think\Controller;
class Index extends Controller
{
    public function index(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();







        $this->assign('user',$user);
        $this->assign('lunbo',$lunbo);
        return view('index');
    }
    
    
}
