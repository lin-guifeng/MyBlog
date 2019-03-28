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
    //    轮播图是否禁用
    public function lunboStatus(){
        $id = input('get.id');
        $res = model('picture')->lunboStatus($id);
        if($res){
            return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
        }else{
            return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
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

    //    百度图片列表
    public function pictureList(){
        return view('admin-picturelist');
    }
    //    获取百度图片列表数据
    public function pictureData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $res = model('picture')->pictureData($page,$limit);
        echo json_encode($res);
    }
    //    批量导入百度图片
    public function pictureAdd(){
        if ($this->request->isPost()){
            $ajaxData = $this->request->post();
            $data = $this->getPicture($ajaxData['keyword'],$ajaxData['num']);
            $res=model('picture')->pictureAdd($data);
            if($res){
                $this->success("批量添加图片成功","/admin/picture/pictureList");
            }else{
                $this->error("批量添加图片失败","/admin/picture/pictureList");
            }
        }
        return view('admin-pictureadd');
    }
    //    图片删除
    public function pictureDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('picture')->pictureDel($idlist);
        if($res){
            $this->success("删除图片成功","/admin/picture/pictureList");
        }else{
            $this->error("删除图片失败","/admin/picture/pictureList");
        }
    }

    //    兔玩网列表
    public function tuwanList(){
        return view('admin-tuwanlist');
    }
    //    获取兔玩网图片列表数据
    public function tuwanData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $res = model('picture')->tuwanData($page,$limit);
        echo json_encode($res);
    }
    //    批量导入兔玩网图片
    public function tuwanAdd(){
        $data = [];
        for ($i=1;$i<=10;$i++){
            $getData = $this->getTuwan($i);
            $data = array_merge((array)$data,(array)$getData);
        }
        $res = model('picture')->tuwanAdd($data);
        if($res){
            $this->success("批量添加图片成功","/admin/picture/tuwanList");
        }else{
            $this->error("批量添加图片失败","/admin/picture/tuwanList");
        }
    }
    //    兔玩网图片删除
    public function tuwanDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('picture')->tuwanDel($idlist);
        if($res){
            $this->success("删除图片成功","/admin/picture/tuwanList");
        }else{
            $this->error("删除图片失败","/admin/picture/tuwanList");
        }
    }

    public function tuwanTags(){
        $arr = [
          '腿控','女仆','标准福利','兔女郎','旗袍','动漫类','JK制服','运动体操服','黑丝','御姐','网袜','肉丝','其他服装','萝莉','白丝','比基尼','巨乳','死库水','大福利','保守','游戏类','脚控','吊带袜','轻剧情','洛丽塔','丰满微胖'
        ];
        $res = db('tuwan')->field('tags')->select();
        foreach ($res as $key => $val){
            $val['tags'] = json_decode($val['tags']);
            if(is_object($val['tags'])){
                $val['tags'] = (array)$val['tags'];
            }
            foreach ($val['tags'] as &$vals){
                if(in_array($vals,$arr)){
                    $vals = array_search($vals, $arr)+1;
                }
            }
            $val['tags'] = implode(',',$val['tags']);
            $res = db('tuwan')->where('id',$key)->update(['tags' => $val['tags']]);
        }

        dump($res);
    }



}