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
            dump($data);
//            echo json_encode($data);
//            $res=model('article')->articleAdd($data);
//            if($res){
//                $this->success("添加文章成功","/admin/article/articleList");
//            }else{
//                $this->error("添加文章失败","/admin/article/articleList");
//            }
        }
        return view('admin-articleadd');
    }
}



