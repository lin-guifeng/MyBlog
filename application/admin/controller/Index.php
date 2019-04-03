<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Session;
class Index extends Common
{
    public function index(){
        return view('index');
    }

    public function main(){
        return view('main');
    }

//    文章列表
    public function articleList(){
        return view('article_list');
    }

//    添加文章
    public function addArticle(){
        return view('addArticle');
    }


//    上传图片
    public function uppic(){
        $file = request()->file('file');
        if($file){
            $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
//            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $imgurl="http://www.linguifeng.top/uploads/".$info->getSaveName();
                echo json_encode($imgurl);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }

//    环境测试
    public function phpinfo(){
        phpinfo();
    }

//    测试页面
    public function test(){

        if ($this->request->isPost()){
            $page = $this->request->post('page');
//        $page = 1;
            $num = 100;
            $start = ($page-1)*$num;
            $data=db('tuwan')->limit($start,$num)->select();
            foreach ($data as $key => $val){
                $picData = json_decode($val['data']);
                $res[$key]['id'] = $val['id'];
                $thumb = json_decode($val['thumb']);
                $data_pic = json_decode(json_encode($picData['0']),TRUE);
                $details = [];
                for ($i=0;$i<count($thumb);$i++){
                    $result = substr($data_pic['thumb'],0,strrpos($data_pic['thumb'],"/u/"));

                    $a = "http://img4.tuwandata.com/v3/thumb/jpg/";
                    $b = substr($thumb[$i],39,6);
                    $c = substr($result,45);
                    $d = substr($thumb[$i],strpos($data_pic['thumb'],"/u/"));
                    $details[$i] = $a.$b.$c.$d;
                }
                $res[$key]['details'] = $details;
            }

//            $tuwan=db('tuwan')->saveAll($res);
            return $res;
//            if($tuwan){
//                return ['data'=>$tuwan,'code'=>1,'message'=>'操作完成'];
//            }else{
//                return ['data'=>$tuwan,'code'=>0,'message'=>'操作失败'];
//            }
        }

        return view('test');

    }


}
