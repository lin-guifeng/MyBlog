<?php
namespace app\admin\model;

use think\Model;

class Account extends Model
{
    public function accountlist(){
        $res=db('admin')->paginate(1);
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
}




