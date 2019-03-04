<?php
namespace app\admin\controller;
use \think\Controller;
class Picture extends Common
{
    //    轮播图列表
    public function lunboList(){
        return view('admin-lunbolist');
    }
    //    获取轮播图列表数据
    public function lunboData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $res = model('picture')->lunboData($page,$limit);
        echo json_encode($res);
    }

    //    添加轮播图
    public function lunboAdd(){
        if ($this->request->isPost()){
            $ajaxData = $this->request->post();

            $data['url'] = $ajaxData['url'];
            $data['name'] = $ajaxData['name'];
            $data['sort'] = $ajaxData['sort'];
            $res=model('picture')->lunboAdd($data);
            if($res){
                $this->success("添加轮播图成功","/admin/picture/lunboList");
            }else{
                $this->error("添加轮播图失败","/admin/picture/lunboList");
            }
        }
        return view('admin-lunboadd');
    }

    //    轮播图编辑
    public function lunboEdit(){
        $id = $this->request->get('id');
        $res = model('picture')->lunboFind($id);
        if ($this->request->isPost()){
            $ajaxData = $this->request->post();
            $data['url'] = $ajaxData['url'];
            $data['name'] = $ajaxData['name'];
            $data['sort'] = $ajaxData['sort'];
            $res=model('picture')->lunboEdit($id,$data);
            if($res){
                $this->success("修改轮播图成功","/admin/picture/lunboList");
            }else{
                $this->error("修改轮播图失败","/admin/picture/lunboList");
            }
        }
        $this->assign('lunbo',$res);
        return view('admin-lunboedit');
    }


    //    轮播图删除
    public function lunboDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('picture')->lunboDel($idlist);
        if($res){
            $this->success("删除轮播成功","/admin/picture/lunboList");
        }else{
            $this->error("删除轮播失败","/admin/picture/lunboList");
        }
    }

    //图片上传
    public function uploadpic(){
        $file = $this->request->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，这里与TP5的写法有点区别
        $file->size = 524288000;
        $folder = input('folder');
        if ($folder) {
            //保存目录
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . $folder);
        }else{
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        }

        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg 地址
            $filePath = "http://www.linguifeng.top/uploads/".$info->getSaveName();
            $filePath = str_replace("\\","/",$filePath);   //替换\为/
            return json(['success'=>true,'filePath'=>$filePath]);
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}