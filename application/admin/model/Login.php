<?php
namespace app\admin\model;

use think\Model;

class Login extends Model
{

    //获取登录信息
    public function check($data){
        $res=db('admin')->where('name',$data['name'])->where('password',$data['$password'])->find();
        return $res;
    }

}




