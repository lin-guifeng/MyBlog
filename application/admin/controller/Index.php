<?php
namespace app\admin\controller;
use \think\Controller;
class Index extends Common
{
    public function index()
    {
        $res = model('account')->recordList(session['admin_id']);
        $this->assgin('res',$res);
        return view('index');
    }


    public function main()
    {
        return view('main');
    }

//    文章列表
    public function articleList()
    {
        return view('article_list');
    }

//    添加文章
    public function addArticle()
    {
        return view('addArticle');
    }
}
