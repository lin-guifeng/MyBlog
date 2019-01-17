<?php
namespace app\admin\controller;
use \think\Controller;
class Index extends Common
{
    public function index()
    {
        return view('index');
    }

    public function index_v1()
    {
        return view('index_v1');
    }

    public function index_v2()
    {
        return view('index_v2');
    }

    public function index_v3()
    {
        return view('index_v3');
    }

    public function index_v4()
    {
        return view('index_v4');
    }

    public function index_v5()
    {
        return view('index_v5');
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
