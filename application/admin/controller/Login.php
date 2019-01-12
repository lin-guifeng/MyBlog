<?php
namespace app\admin\controller;
use \think\Validate;
use \think\Controller;
class Login extends Controller
{
    public function _initialize() {
         header("Content-Type:text/html; charset=utf-8");
        if (!isset($_SESSION['user'])) {
            echo "<script>alert('请先登陆！');document.location.href='/admin/Login/login';</script>";
        }
        $this->checkAdminSession();
    }
    public function checkAdminSession() {
    // 设置超时为10分
        $nowtime = time();
        $s_time = $_SESSION['logintime'];
        if (($nowtime - $s_time) > 6000000) {
            session_unset();
            session_destroy();
            echo "<script>alert('当前用户登录超时，请重新登录！');document.location.href='/index.php/Home/Login/login';</script>";
            $_SESSION['logintime'] = $nowtime;
        }
    }
    public function login()
    {
        $ip = $this->ip();
//        dump('123');
//        dump($ip);
//        exit;
        return view('login');
    }

    public function login_v2()
    {
        return view('login_v2');
    }

    public function register()
    {
    	return view('register');
    }
    public function ip() {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    }
    public function logincheck()
    {

        $account=input('post.account');
        $password=input('post.password');
        $rule = [
            'account'=>'require',
            'password'=> 'require',
        ];
        $msg = [
            'account.require'=>'账号必须填写',
            'password.require' => '密码必须填写',
        ];
        $data = [
            'account'  => $account,
            'password'=>$password,
        ];
        $validate = new Validate($rule, $msg);
        $result   = $validate->check($data);
        if(!$result){
            $this->error($validate->getError());
        }else{
            $password=md5($password);
            $login=model('Login');
            $res=$login->check($account,$password);

            if($res==true){
                session('admin_id',$res['id']);
                session('admin_name',$res['name']);
                session('admin_img',$res['img']);
                session('long_time',time());
                $this->success('登录成功','admin/index/index');
            }else{
                $this->error('登录失败,请重新登录','admin/login/login');
            }
        }
    }
    public function loginout(){
        session('admin_id',NULL);
        session('admin_name',NULL);
        session('admin_img',NULL);
        $this->success('请重新登录','admin/login/login');
    }
    
}
