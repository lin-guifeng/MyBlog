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
            $num = 10;
            $start = ($page-1)*$num;
            $data=db('tuwan')->limit($start,$num)->select();
            $res = [];
            $picdata = [];
            $thumb = [];
            foreach ($data as $key => $val){
                $picdata = json_decode($val['data']);

                $dataarr = [
                'pic' => $picdata[0]['pic'],
                'ratio' => $picdata[0]['ratio'],
                'thumb' => $picdata[0]['thumb'],
                ];
                $thumb = json_decode($val['thumb']);
                $res[$key]['id'] = $val['id'];
                for ($i=3;$i<count($thumb);$i++){

                    $picdata[] = $dataarr;
                    
                }
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
