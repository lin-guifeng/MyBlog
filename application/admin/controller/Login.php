<?php
namespace app\admin\controller;
use \think\Validate;
use \think\Controller;
class Login extends Controller
{
    public function login()
    {

        if ($this->request->isPost()){
            $data = $this->request->post();
            $rule = [
                'name'=>'require',
                'password'=> 'require',
            ];
            $msg = [
                'name.require'=>'账号必须填写',
                'password.require' => '密码必须填写',
            ];

            $validate = new Validate($rule, $msg);
            $result   = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $data['password']=md5($data['password']);

                $res=model('Login')->check($data);

                if($res==true){
                    $record['ip']= $this->ip();
                    $record['aid']= $res['id'];

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

    public function loginout(){
        session('admin_id',NULL);
        session('admin_name',NULL);

        $this->success('请重新登录','admin/login/login');
    }
    
}
