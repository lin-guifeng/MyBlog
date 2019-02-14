<?php
namespace app\admin\model;

use think\Model;

class Account extends Model
{
    public function accountList(){
        $res=db('admin')->paginate(10);
        return $res;
    }

    public function recordList(){
        $res=db('admin_record')->paginate(10);

        $res = db('admin_record')->alias('r')
            ->join('admin a',"a.id = u.aid")
            ->field('r.id,r.aid,r.time,r.ip,r.area,a.name,a.user,a.group_id')
            ->paginate(10);
        foreach ($res as &$val){
            $val['group'] = db('admin_group')->where('id',$val['group_id'])->field('name');
        }
        return $res;
    }

    public function types(){
        $res=db('model')->paginate(5);
        return $res;
    }
    public function accountAdd($data){
        $res=db('admin')->insert($data);
        return $res;
    }
    public function del($admin_id){
        $res=db('admin')->where('id',$admin_id)->delete();
        return $res;
    }
    public function edit($admin_id){
        $res=db('admin')->where('id',$admin_id)->find();
        return $res;
    }
    public function edits($admin_id,$data){
        $ret=db('admin')->where('id',$admin_id)->update($data);
        return $ret;
    }

    public function groupList(){
        $res=db('group')->paginate(10);
        return $res;
    }

    public function groupAdd($data){
        $res=db('group')->insert($data);
        return $res;
    }

    public function record(){
        $res=db('admin_record')->paginate(5);
        return $res;
    }
}




