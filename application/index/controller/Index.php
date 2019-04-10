<?php
namespace app\index\controller;
use \think\Controller;
class Index extends Controller
{
    public function index(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();
        $data = model('index')->getList();
        foreach ($data as &$value){
//            $value['con'] = mb_substr ( $value['content'], 0,100,'utf-8' );
            $value['time']=date('Y-m-d',strtotime($value['time']));
        }

        $this->assign('data',$data);
        $this->assign('user',$user);
        $this->assign('lunbo',$lunbo);
        return view('index');
    }
    public function index1(){
        $user = model('index')->user();
        $lunbo = model('index')->lunbo();
        $data = model('index')->getList();
        foreach ($data as &$value){
            $content_01 = $value["content"];//从数据库获取富文本content
            $content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
            $content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
            $contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
            $value['con'] = mb_substr ( $contents, 0,100,'utf-8' );
        }
        $this->assign('data',$data);
        $this->assign('user',$user);
        $this->assign('lunbo',$lunbo);
        return view('index1');
    }
    public function phpinfo(){
        echo phpinfo();
    }
    public function lists(){
        return view('list');
    }
    public function info(){
        $id = input('get.id');
        $data = model('index')->getinfo($id);
        foreach ($data as &$val){
            $val['time']=date('Y-m-d',strtotime($val['time']));
        }
        $this->assign('data',$data);
        return view('info');
    }
    public function list2(){
        return view('list2');
    }
    public function list3(){
        return view('list3');
    }
    public function time(){
        return view('time');
    }
    public function about(){
        return view('about');
    }
    public function daohang(){
        return view('daohang');
    }

    public function tuwan(){
        if ($this->request->isPost()) {
            $page = $this->request->post('page');
            $start = ($page-1)*20+1;
            $end = $page*20;
            $data = db('tuwan')->field('id,data')->limit($start,$end)->order("id desc")->select();
            foreach ($data as &$val) {
                $val['pic'] = json_decode($val['data'])['0']['thumb'];
            }
            return ['data'=>$data,'code'=>0,'message'=>'获取成功！'];
        }
//        $this->assign('data',$data);
        return view('tuwan');
    }
    public function tuwaninfo(){

        $data = db('tuwan')->where('id',input('get.id'))->find();
        $data['thumb'] = json_decode($data['thumb'],true);
        $data['details'] = json_decode($data['details'],true);
        $this->assign('data',$data);
        return view('tuwaninfo');
    }


}
