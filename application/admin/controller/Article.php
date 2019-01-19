<?php

namespace app\admin\controller;
use \think\Controller;

class Article extends Common
{
    public function articleList(){
        $res = model('article')->articlelist();
        $page= $res->render();
        $this->assign('page',$page);
        $this->assign('article',$res);
        return view('admin-articlelist');
    }

    public function articleAdd(){

        return view('admin-articleadd');
    }
}