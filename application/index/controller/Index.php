<?php
namespace app\index\controller;
use \think\Controller;
class Index
{
    public function index(){
        $lunbo = M('index')->lunbo();
        $this->assign('lunbo',$lunbo);
        return view('index');
    }
    
    
}
