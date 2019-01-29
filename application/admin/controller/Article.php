<?php

namespace app\admin\controller;
use \think\Controller;

class Article extends Common
{
//    文章列表
    public function articleList(){
        $res = model('article')->articlelist();
        $page= $res->render();
        $this->assign('page',$page);
        $this->assign('article',$res);
        return view('admin-articlelist');
    }

//    添加文章
    public function articleAdd(){
        if ($this->request->isPost()){
            $data = $this->request->post();
            $res=model('article')->accountAdd($data);
            if($res){
                $this->success("添加文章成功","/admin/article/articleList");
            }else{
                $this->error("添加文章失败","/admin/article/articleList");
            }
        }
        return view('admin-articleadd');
    }
}



