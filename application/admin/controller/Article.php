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
            $article = $this->request->post();
            $data['img'] = $article['img'];
            $data['title'] = $article['title'];
            $data['content'] = $article['txt'];
            $res=model('article')->articleAdd($data);
            if($res){
                $this->success("添加文章成功","/admin/article/articleList");
            }else{
                $this->error("添加文章失败","/admin/article/articleList");
            }
        }
        return view('admin-articleadd');
    }



//    获取分类数据
    public function classifyList(){
        if ($this->request->isGet()) {
            $limit = trim(input('limit'));
            $offset = trim(input('offset'));
            $page = floor($offset / $limit) + 1;
            # 获取并且计算 页号 分页大小
            $list = db('admin_classify')
                ->page($page, $limit)
                ->order('sort desc')
                ->select();
            foreach ($list as &$val) {
                if ($val['status'] == '1') {
                    $val['status'] == '正常';
                } else {
                    $val['status'] == '禁用';
                }
            }
            $count = db('admin_classify')->count();
            $res = [
                'rows' => $list,
                'total' => $count,
            ];
            echo json_encode($res);
        }
        return view('admin-classifylist');
    }

//    分类添加
    public function classifyAdd(){
        if ($this->request->isPost()){
            $classify = $this->request->post();
            if($classify['status']=='on'){
                $classify['status']==1;
            }else{
                $classify['status']==0;
            }
            $res=model('article')->classifyAdd($classify);
            if($res){
                $this->success("添加分类成功","/admin/article/classifyList");
            }else{
                $this->error("添加分类失败","/admin/article/classifyList");
            }
        }
        return view('admin-classifyadd');
    }

    //    分类编辑
    public function classifyEdit(){
        if ($this->request->isPost()){
            $classify = $this->request->post();
            if($classify['status']==true){
                $classify['status']==1;
            }else{
                $classify['status']==0;
            }
            $res=model('article')->classifyEdit($classify);
            if($res){
                $this->success("修改分类成功","/admin/article/articleList");
            }else{
                $this->error("修改分类失败","/admin/article/articleList");
            }
        }
        return view('admin-classifyedit');
    }

    //    分类删除
    public function classifyDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('article')->recordDel($idlist);
        if($res){
            $this->success("删除分类成功","/admin/article/articleList");
        }else{
            $this->error("删除分类失败","/admin/article/articleList");
        }
    }




}






