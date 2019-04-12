<?php
namespace app\admin\controller;
use \think\Validate;
use \think\Controller;
use \think\Session;
class Login extends Controller
{
//    登录
    public function login()
    {

        if ($this->request->isPost()){
            $data = $this->request->post();
            $rule = [
                'user'      =>'require',
                'password'  => 'require',
            ];
            $msg = [
                'user.require'      =>'账号必须填写',
                'password.require'  => '密码必须填写',
            ];

            $validate = new Validate($rule, $msg);
            $result   = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $code=input('post.captcha');
                $captcha = new \think\captcha\Captcha();
                if($captcha->check($code)===false){
                    $this->error('验证码错误,请重新登录','admin/login/login');
                }
                $data_login['user']=md5($data['user']);
                $data_login['password']=md5($data['password']);

                $res=model('Login')->check($data_login);
                $remember = input('post.remember');
                if (!empty($remember)) {
                    //如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面
                    setcookie('username', $res['user'], time() + 3600 * 24 * 365);
                    setcookie('password', $res['password'], time() + 3600 * 24 * 365);
                }
                if($res==true){
                    $record['ip']   = $this->ip();
                    $record['aid']  = $res['id'];
                    $record['area']  = $this->get_area($record['ip']);
                    $record['time'] = date('y-m-d H:i:s',time());
                    model('Login')->record($record);
                    session('admin_id',$res['id']);
                    session('admin_name',$res['name']);
                    session('long_time',time());
                    $this->success('登录成功','admin/index/index');
                }else{
                    $this->error('登录失败,请重新登录','admin/login/login');
                }
            }
        }
        return view('login');
    }

//    获取ip
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

//    获取ip所在地区
    public function get_area($ip = ''){
        if($ip == ''){
            $ip = ip();
        }
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";//淘宝
        //$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);//新浪
        $ret = https_request($url);
        $arr = json_decode($ret,true);
        $res = $arr['data']['region']."-".$arr['data']['city'];
        return $res;
    }


//    退出登录
    public function loginout(){
        session('admin_id',NULL);
        session('admin_name',NULL);
        if (!empty($_COOKIE['username']) || !empty($_COOKIE['password'])) {
            setcookie('username', null, time() - 3600 * 24 * 365);
            setcookie('password', null, time() - 3600 * 24 * 365);
        }
        $this->success('请重新登录','admin/login/login');
    }

    //显示验证码
    public function show_captcha(){
        $captcha = new \think\captcha\Captcha();
        $captcha->imageW=150;
        $captcha->imageH = 32;  //图片高
        $captcha->fontSize =14;  //字体大小
        $captcha->length   = 5;  //字符数
        $captcha->fontttf = '5.ttf';  //字体
        $captcha->expire = 300;  //有效期
        $captcha->useNoise = false;  //不添加杂点
//        $captcha->reset    = true;
//        $captcha->useCurve =  false;
//        $captcha->useImgBg = true;
        return $captcha->entry();
    }


}
