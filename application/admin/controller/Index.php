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
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
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

    public function test(){
        echo "时间戳：".time();
    }


}
