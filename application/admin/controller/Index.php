<?php
namespace app\admin\controller;
use \think\Controller;
class Index extends Common
{
    public function index()
    {
        dump(url('admin/Account/accountList'));
        exit;
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
