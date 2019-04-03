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
            $num = 10;
            $start = ($page-1)*$num;
            $data=db('tuwan')->limit($start,$num)->select();
            foreach ($data as $key => $val){
                $res[$key]['data'] = json_decode($val['data']);
                $res[$key]['id'] = $val['id'];
                $res[$key]['thumb'] = json_decode($val['thumb']);
//                $data_pic = $res[$key]['data']['0'];
                $data_pic = json_decode(json_encode($res[$key]['data']['0']),TRUE);
                $details = [];
                for ($i=0;$i<count($res[$key]['thumb']);$i++){
                    $result = substr($data_pic['thumb'],0,strrpos($data_pic['thumb'],"/u/"));

                    $a = "http://img4.tuwandata.com/v3/thumb/jpg/";
                    $b = substr($res[$key]['thumb'][$i],39,6);
                    $c = substr($result,45);

                    $d = substr($res[$key]['thumb'][$i],strpos($data_pic['thumb'],"/u/"));

//                    substr($data_pic['thumb'],45,10);
                    $details[$i] = $a.$b.$c.$d;


                }
                $res[$key]['details'] = $details;

//                $thumb = "http://img4.tuwandata.com/v3/thumb/jpg/NjY3Yi
//                wx
//                NTgsMTU4LDksMywxLC0xLE5PTkUsLCw5MA==
//                /u/GLDM9lMIBglnFv7YKftLBup2YNoaaYyHpxtx61x7TAw1OhW9opuBDHVRaFUe3iYEeQ513PSMuLSI75j8NhJhKlP4rC8ibQimQcXA1kBsLKMq.jpg";
//                $pic = "http://img4.tuwandata.com/v3/thumb/jpg/NjY3Yi
//                wx
//                MTI1LDAsOSwzLDEsLTEsTk9ORSwsLDkw
//                /u/GLDM9lMIBglnFv7YKftLBup2YNoaaYyHpxtx61x7TAw1OhW9opuBDHVRaFUe3iYEeQ513PSMuLSI75j8NhJhKlP4rC8ibQimQcXA1kBsLKMq.jpg";
//
//                $thumb1 = "http://img4.tuwandata.com/v3/thumb/jpg/MTAzYi
//                wx
//                NTgsMTU4LDksMywxLC0xLE5PTkUsLCw5MA==
//                /u/GLDM9lMIBglnFv7YKftLBup2YNoaaYyHpxtx61x7TAwNMgPjWt2elOIjcIGdkGANKeN3E876CqrbmJ0fnbH7ytmLutT4f0irFJ9NCwe5k9mE.jpg";
//                $pic1 = "http://img4.tuwandata.com/v3/thumb/jpg/MTAzYi
//                w2MzksMCw5LDMsMSwtMSxOT05FLCwsOTA=
//                /u/GLDM9lMIBglnFv7YKftLBup2YNoaaYyHpxtx61x7TAwNMgPjWt2elOIjcIGdkGANKeN3E876CqrbmJ0fnbH7ytmLutT4f0irFJ9NCwe5k9mE.jpg";
//
//                $thumb2 = "http://img4.tuwandata.com/v3/thumb/jpg/Zjg2OC
//                wx
//                NTgsMTU4LDksMywxLC0xLE5PTkUsLCw5MA==/u/GLDM9lMIBglnFv7YKftLBGMPjX1086xD88jhANdH32N9vAKmqokJp9GP4c3ZLIDhIoF82NYCkRyrST60Bq6F7qw87ab4Ajxdfkbb2fhdfKeA.jpg";
//                $pic2 = "http://img4.tuwandata.com/v3/thumb/jpg/Zjg2OC
//                wx
//                MDAwLDAsOSwzLDEsLTEsTk9ORSwsLDkw/u/GLDM9lMIBglnFv7YKftLBGMPjX1086xD88jhANdH32N9vAKmqokJp9GP4c3ZLIDhIoF82NYCkRyrST60Bq6F7qw87ab4Ajxdfkbb2fhdfKeA.jpg";

            }

//            json_decode(json_encode($res[$key]['data']['0']),TRUE);
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
