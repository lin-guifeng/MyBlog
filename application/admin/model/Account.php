<?php
namespace app\admin\model;

use think\Model;

class Account extends Model
{
    public function accountData($page,$limit){
        $list = db('admin')
            ->page($page,$limit)
            ->order('time desc')
            ->select();
        $count = db('admin')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        return $res;
    }
    public function accountAdd($data){
        $res=db('admin')->insert($data);
        return $res;
    }
    public function accountFind($admin_id){
        $res=db('admin')->where('id',$admin_id)->find();
        return $res;
    }
    public function accountEdit($admin_id,$data){
        $ret=db('admin')->where('id',$admin_id)->update($data);
        return $ret;
    }
    public function accountDel($admin_id){
        $res=db('admin')->delete($admin_id);
        return $res;
    }
    public function accountStatus($id){
        $status=db('admin')->where('id',$id)->value('status');
        if($status=='0'){
            $res = db('admin')->where('id', $id)->update(['status'  => '1',]);
        }else{
            $res = db('admin')->where('id', $id)->update(['status'  => '0',]);
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
}




