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
                'name'      =>'require',
                'password'  => 'require',
            ];
            $msg = [
                'name.require'      =>'账号必须填写',
                'password.require'  => '密码必须填写',
            ];

            $validate = new Validate($rule, $msg);
            $result   = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $data['password']=md5($data['password']);

                $res=model('Login')->check($data);

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
        $this->success('请重新登录','admin/login/login');
    }
    
}
