<?php
namespace app\admin\model;

use think\Model;

class Picture extends Model
{
    public function lunboData($page,$limit){
        $list = db('lunbo')
            ->page($page,$limit)
            ->order('time desc')
            ->select();
        $count = db('lunbo')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        return $res;
    }
    public function lunboAdd($data){
        $res=db('lunbo')->insert($data);
        return $res;
    }
    public function lunboFind($id){
        $res=db('lunbo')->where('id',$id)->find();
        return $res;
    }
    public function lunboEdit($id,$data){
        $res=db('lunbo')->where('id',$id)->update($data);
        return $res;
    }
    public function lunboDel($id){
        $res=db('lunbo')->delete($id);
        return $res;
    }
    public function accountStatus($id){
        $status=db('account')->where('id',$id)->value('status');
        if($status=='0'){
            $res = db('account')->where('id', $id)->update(['status'  => '1',]);
        }else{
            $res = db('account')->where('id', $id)->update(['status'  => '0',]);
        }
        return $res;
    }


    public function groupData($page,$limit){
        $list = db('group')
            ->page($page,$limit)
            ->order('time desc')
            ->select();
        $count = db('group')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        return $res;
    }
    public function groupAdd($data){
        $res=db('group')->insert($data);
        return $res;
    }
    public function groupFind($id){
        $res=db('group')->where('id',$id)->find();
        return $res;
    }
    public function groupEdit($id,$data){
        $res=db('group')->where('id',$id)->update($data);
        return $res;
    }
    public function groupDel($id){
        $res=db('group')->delete($id);
        return $res;
    }
    public function groupStatus($id){
        $status=db('group')->where('id',$id)->value('status');
        if($status=='0'){
            $res = db('group')->where('id', $id)->update([
                'status'  => '1',
            ]);
        }else{
            $res = db('group')->where('id', $id)->update([
                'status'  => '0',
            ]);
        }
        return $res;
    }


    public function recordDel($idlist){
        $res = db('admin_record')->delete($idlist);
        return $res;
    }

    //图片上传
    public function uploadpic(){
        $file = $this->request->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，这里与TP5的写法有点区别
        $file->size = 524288000;
        $folder = input('folder');
        if ($folder) {
            //保存目录
            $Path = 'public' . DS . 'uploads' . DS . $folder;
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . $folder);
        }else{
            $Path = 'public' . DS . 'uploads';
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        }

        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg 地址
            $filePath = "/".$Path. DS .$info->getSaveName();
            $filePath = str_replace("\\","/",$filePath);   //替换\为/
            return json(['success'=>true,'filePath'=>$filePath]);
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}




