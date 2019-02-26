<?php
namespace app\admin\model;

use think\Model;

class Login extends Model
{

    //获取登录信息
    public function check($data){
        $res=db('admin')->where(['user'=>$data['user'],'password'=>$data['password'],'status'=>'1'])->find();
        return $res;
    }

    //记录登录信息
    public function record($data){
        $res=db('admin_record')->insert($data);
        return $res;
    }
}




