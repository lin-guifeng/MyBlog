<?php
namespace app\admin\model;

use think\Model;

class Picture extends Model
{
    public function lunboData($page,$limit){
        $list = db('lunbo')
            ->page($page,$limit)
            ->order('sort desc')
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
    public function lunboStatus($id){
        $status=db('lunbo')->where('id',$id)->value('status');
        if($status=='0'){
            $res = db('lunbo')->where('id', $id)->update(['status'  => '1',]);
        }else{
            $res = db('lunbo')->where('id', $id)->update(['status'  => '0',]);
        }
        return $res;
    }

    public function pictureData($page,$limit){
        $list = db('picture')
            ->page($page,$limit)
            ->order('id desc')
            ->select();
        $count = db('picture')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        return $res;
    }
    public function pictureAdd($data){
        $res=db('picture')->insertAll($data);
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


}




