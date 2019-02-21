<?php
namespace app\admin\model;

use think\Model;

class Article extends Model
{
    public function articleList(){
        $res=db('article')->paginate(10);
        return $res;
    }

    public function types(){
        $res=db('model')->paginate(5);
        return $res;
    }
    public function articleAdd($data){
        $res=db('article')->insert($data);
        return $res;
    }
    public function classifyAdd($data){
        $res=db('classify')->insert($data);
        return $res;
    }
    public function classifyEdit($id,$data){
        $res=db('classify')->where('id',$id)->update($data);
        return $res;
    }
    public function classifyDel($id){
        $res=db('classify')->where('id',$id)->delete();
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




