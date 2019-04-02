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
//        $arr = [
//            '腿控','女仆','标准福利','兔女郎','旗袍','动漫类','JK制服','运动体操服','黑丝','御姐','网袜','肉丝','其他服装','萝莉','白丝','比基尼','巨乳','死库水','大福利','保守','游戏类','脚控','吊带袜','轻剧情','洛丽塔','丰满微胖'
//        ];
//        13位时间戳
//        list($t1, $t2) = explode(' ', microtime());
//        $time = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
//        echo "时间戳：".$time;
//        dump($arr);
//        foreach ($arr as $val){
//            $res = db('tuwan_tags')->insert(['name'=>$val]);
//        }
        if ($this->request->isPost()){
            $page = $this->request->post('page');
            $data=db('tuwan_url')->limit($page,100)->select();
            foreach ($data as $key => $val){
                $val['text'] = substr($val['text'],strpos($val['text'],'(')+1);
                $val['text'] = substr($val['text'], 0, -1);
                $val['text'] = json_decode($val['text'],true);
                if($val['text']!=null){
                    if($val['text']['error']!='1'&&$val['text']['thumb']!=null){
//                        $res[$key] = $val['text'];
                        $res[$key]['pic'] = json_encode($val['text']['pic']);
                        $res[$key]['tags'] = json_encode($val['text']['tags']);
                        $res[$key]['thumb'] = json_encode($val['text']['thumb']);
                        $res[$key]['title'] = $val['text']['title'];
                        $res[$key]['bgm'] = $val['text']['bgm'];
                        $res[$key]['bgm_name'] = $val['text']['bgm_name'];
                        $res[$key]['bgm_img'] = $val['text']['bgm_img'];
                        $res[$key]['pid'] = $val['text']['id'];
                        $res[$key]['data'] = json_encode($val['text']['data']);
                    }
                }
            }
            return $res;
//            if($res){
//                return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
//            }else{
//                return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
//            }
        }

        return view('test');

    }


}
