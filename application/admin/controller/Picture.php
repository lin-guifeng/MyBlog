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
        $res = db('tuwan_copy')->field('tags')->select();
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
            $res = db('tuwan')->where('id',$key+1)->update(['tags' => $val['tags']]);
        }
        dump($res);
    }

    public function tuwan(){
        return view("admin-tuwanoperation");
    }
    public function tuwan_a(){
        if ($this->request->isPost()){
            $num = $this->request->post('num');
            $start = ($num-1)*100+1;
            $end = $num*100;
            $html=[];
            for($i=$start;$i<=$end;$i++){
                $urls = "https://api.tuwan.com/apps/Welfare/detail?type=image&dpr=3&id=".$i;
                $html = array_merge((array)$html,(array)get($urls));
            }
            foreach($html as $key=>$value){
                $res[$key]['text'] = $value;
            }
            $res=db('tuwan_url')->insertAll($res);
            $count = db('tuwan_url')->count();
            if($res){
                return ['data'=>$count,'code'=>1,'message'=>'操作完成'];
            }else{
                return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
            }
        }
    }
    public function tuwan_b(){
        if ($this->request->isPost()){
            $page = $this->request->post('page');
            $num = 100;
            $start = ($page-1)*$num;
            $data=db('tuwan_url')->limit($start,$num)->select();
            $max_num = db('tuwan')->max('pid');
            $is_have = true;
            if(!$data){
                return ['data'=>1,'code'=>2,'message'=>'没有添加这一批次数据，请修改批次！'];
            }
            foreach ($data as $key => $val){
                $val['text'] = substr($val['text'],strpos($val['text'],'(')+1);
                $val['text'] = substr($val['text'], 0, -1);
                $val['text'] = json_decode($val['text'],true);
                if($val['text']!=null){
                    if($val['text']['error']!='1'&&$val['text']['thumb']!=null){
                        if($max_num>=$val['text']['id']){
                            $is_have = false;
                            break;
                        }
                        $res[$key]['tags'] = json_encode($val['text']['tags']);
                        $res[$key]['thumb'] = json_encode($val['text']['thumb']);
                        $res[$key]['title'] = $val['text']['title'];
                        $res[$key]['bgm'] = $val['text']['bgm'];
                        $res[$key]['bgm_name'] = $val['text']['bgm_name'];
                        $res[$key]['bgm_img'] = $val['text']['bgm_img'];
                        $res[$key]['pid'] = $val['text']['id'];
                        $res[$key]['data'] = json_encode($val['text']['data']);
                    }
                }
            }

            if($is_have==true){
                $tuwan=db('tuwan')->insertAll($res);
            }else{
                return ['data'=>1,'code'=>2,'message'=>'没有符合条件数据,请修改批次！'];
            }
            if($tuwan){
                return ['data'=>$tuwan,'code'=>1,'message'=>'操作完成'];
            }else{
                return ['data'=>$tuwan,'code'=>0,'message'=>'操作失败'];
            }
        }
    }

    public function tuwan_c(){
        if ($this->request->isPost()){
            $page = $this->request->post('page');
//        $page = 1;
            $num = 100;
            $start = ($page-1)*$num;
            $data=db('tuwan')->limit($start,$num)->select();
            foreach ($data as $key => $val){
                $picData = json_decode($val['data']);
                $res[$key]['id'] = $val['id'];
                $thumb = json_decode($val['thumb']);
                $data_pic = json_decode(json_encode($picData['0']),TRUE);
                $details = [];
                for ($i=0;$i<count($thumb);$i++){
                    $result = substr($data_pic['thumb'],0,strrpos($data_pic['thumb'],"/u/"));

                    $a = "http://img4.tuwandata.com/v3/thumb/jpg/";
                    $b = substr($thumb[$i],39,6);
                    $c = substr($result,45);
                    $d = substr($thumb[$i],strpos($data_pic['thumb'],"/u/"));
                    $details[$i] = $a.$b.$c.$d;
                }
                $res[$key]['details'] = $details;
            }

//            $tuwan=db('tuwan')->saveAll($res);
            return $res;
//            if($tuwan){
//                return ['data'=>$tuwan,'code'=>1,'message'=>'操作完成'];
//            }else{
//                return ['data'=>$tuwan,'code'=>0,'message'=>'操作失败'];
//            }
        }

        return view('test');

    }
    public function tuwan_del(){
        $tuwan=db('tuwan_url')->deleete(true);
        if($tuwan){
            return ['data'=>$tuwan,'code'=>1,'message'=>'删除成功！'];
        }else{
            return ['data'=>$tuwan,'code'=>0,'message'=>'删除失败！'];
        }
    }



}