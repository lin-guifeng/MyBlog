<?php
namespace app\admin\model;

use think\Model;

class Article extends Model
{
    public function articleAdd($data){
        $res=db('article')->insert($data);
        return $res;
    }
    public function articleData($page,$limit){
        $list = db('article')
            ->page($page,$limit)
            ->order('time desc')
            ->select();
        $count = db('article')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        return $res;
    }
    public function articleFind($id){
        $res=db('article')->where('id',$id)->find();
        return $res;
    }
    public function articleEdit($id,$data){
        $res=db('article')->where('id',$id)->update($data);
        return $res;
    }
    public function articleDel($id){
        $res=db('article')->delete($id);
        return $res;
    }
    public function articleStatus($id){
        $status=db('article')->where('id',$id)->value('status');
        if($status=='0'){
            $res = db('article')->where('id', $id)->update(['status'  => '1',]);
        }else{
            $res = db('article')->where('id', $id)->update(['status'  => '0',]);
        }
        return $res;
    }


    public function classifyData($page,$limit){
        $list = db('classify')
            ->page($page,$limit)
            ->order('time desc')
            ->select();
        $count = db('classify')->count();
        $res = [
            'rows' => $list,
            'total' => $count,
        ];
        return $res;
    }
    public function classifyAdd($data){
        $res=db('classify')->insert($data);
        return $res;
    }
    public function classifyFind($id){
        $res=db('classify')->where('id',$id)->find();
        return $res;
    }
    public function classifyEdit($id,$data){
        $res=db('classify')->where('id',$id)->update($data);
        return $res;
    }
    public function classifyDel($id){
        $res=db('classify')->delete($id);
        return $res;
    }
    public function classifyStatus($id){
        $status=db('classify')->where('id',$id)->value('status');
        if($status=='0'){
            $res = db('classify')->where('id', $id)->update(['status'  => '1',]);
        }else{
            $res = db('classify')->where('id', $id)->update(['status'  => '0',]);
        }
        return $res;
    }


}




