<?php
namespace app\admin\model;

use think\Model;

class Article extends Model
{
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


}




