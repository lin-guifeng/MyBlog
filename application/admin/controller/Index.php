<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Session;
class Index extends Common
{
    public function index(){
        $res = model('account')->recordList(session('admin_id'));
        $this->assign('res',$res);
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

    public function uppic(){
        $file = request()->file('file');
//        echo $file;
//        return;
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            echo json_encode($info->getExtension());
            return;
//            $this->ajaxReturn($info->getFilename(),'上传成功','1');

        }else{
            echo json_encode($file->getError());
            return;
        }
    }


}
