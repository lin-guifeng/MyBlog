<?php

namespace app\admin\controller;
use \think\Controller;

class Article extends Common
{
    //    文章列表
    public function articleList(){
        return view('admin-articlelist');
    }
    //    获取文章列表数据
    public function articleData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $res = model('article')->articleData($page,$limit);
        echo json_encode($res);
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
    //    文章编辑
    public function articleEdit(){
        $id = $this->request->get('id');
        $res = model('article')->articleFind($id);
        if ($this->request->isPost()){
            $article = $this->request->post();
            $data['img'] = $article['img'];
            $data['title'] = $article['title'];
            $data['content'] = $article['txt'];
            $res=model('article')->articleEdit($id,$data);
            if($res){
                $this->success("修改文章成功","/admin/article/articleList");
            }else{
                $this->error("修改文章失败","/admin/article/articleList");
            }
        }
        $this->assign('article',$res);
        return view('admin-articleedit');
    }
    //    文章删除
    public function articleDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('article')->articleDel($idlist);
        if($res){
            $this->success("删除文章成功","/admin/article/articleList");
        }else{
            $this->error("删除文章失败","/admin/article/articleList");
        }
    }
    //    文章状态是否下架
    public function articleStatus(){
        $id = input('get.id');
        $res = model('Article')->articleStatus($id);
        if($res){
            return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
        }else{
            return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
        }
    }

    //    分类列表
    public function classifyList(){
        return view('admin-classifylist');
    }

    //    获取分类数据
    public function classifyData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $list = db('classify')
            ->page($page,$limit)
            ->order('sort desc')
            ->select();
        foreach ($list as &$val){
            if($val['status']=='1'){
                $val['status']=='正常';
            }else{
                $val['status']=='禁用';
            }
        }
        $count = db('classify')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        echo json_encode($res);
    }

    //    分类添加
    public function classifyAdd(){
        if ($this->request->isPost()){
            $classify = $this->request->post();
            $classify['status']==0;
            if(isset($classify['status'])){
                $classify['status']==1;
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
        $id = $this->request->get('id');
        $res = model('article')->classifyFind($id);
        if ($this->request->isPost()){
            $classify = $this->request->post();
            $classify['status']==0;
            if($classify['status']=='on'){
                $classify['status']==1;
            }
            $res=model('article')->classifyEdit($id,$classify);
            if($res){
                $this->success("修改分类成功","/admin/article/articleList");
            }else{
                $this->error("修改分类失败","/admin/article/articleList");
            }
        }
        $this->assign('classify',$res);
        return view('admin-classifyedit');
    }

    //    分类删除
    public function classifyDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('article')->classifyDel($idlist);
        if($res){
            $this->success("删除分类成功","/admin/article/articleList");
        }else{
            $this->error("删除分类失败","/admin/article/articleList");
        }
    }
    //    分类状态是否禁用
    public function classifyStatus(){
        $id = input('get.id');
        $res = model('Article')->classifyStatus($id);
        if($res){
            return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
        }else{
            return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
        }
    }




}






