<?php
namespace app\admin\controller;
// use app\admin\controller\Common;
use \think\Controller;
use \think\Validate;
use \think\Config;

class Account extends Common
{
    public function accountList(){

        $res=model('Account')->accountlist();
        $page=$res->render();
        $this->assign('page',$page);
        $this->assign('admin',$res);
        return view('admin-accountlist');
    }

    public function accountAdd(){
        if ($this->request->isPost()){
            $data = $this->request->post();
            $rule = [
                'name|用户名'   => 'require|min:3|max:15|alphaNum|unique:admin',
                'password|密码' => 'confirm|min:6|max:20|alphaDash',
            ];
            $msg = [
                'name.require'      => '用户名必须填写',
                'name.min'          => '用户名最少要3个字符',
                'name.max'          => '用户名最多不能超过15个字符',
                'name.alphaNum'     => '用户名只能由字母和数字组成',
                'name.unique'       => '用户名已注册',
                'password.confirm'  => '密码必须一致',
                'password.min'      => '密码至少6个字符',
                'password.max'      => '密码最多不能超过20个字符',
                'password.alphaDash'=> '密码只能由字母和数字，_和-组成',
            ];

            $validate = new Validate($rule, $msg);
            $result   = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $data['password']=md5($data['password']);
                $datas=
                    [
                        'name'=>$data['name'],
                        'password'=>$data['password'],
                    ];
                $res=model('Account')->accountAdd($datas);
                if($res){
                    $this->success("添加管理员成功","/admin/account/accountList");
                }else{
                    $this->error("添加管理员失败","/admin/account/accountList");
                }

            }

        }
        return view('admin-accountadd');


    }

    public function addaccount(){
        $name=input('post.name');
        $account=input('post.account'); 
        $img=input('post.imgs');    
        $password=input('post.pwd');
        $repwd=input('post.repwd');
        $rule = [
            'name'=>'require',
            'account'  => 'unique:admin|alphaDash|length:4,25',
            'password'=> 'require|confirm:repwd',  
            'img'=>'require',              
        ];        
        $msg = [
            'name.require'=>'姓名不能为空',
            'account.unique'=>'账号已存在',
            'account.alphaDash'=>'账号只能由字母数字下划线破折号组成',
            'account.length'=>'账号长度在4-25之间',
            'password.require' => '密码必须填写',
            'password.confirm' => '密码不一致',
            'img.require'=>'图片不能为空',
        ];        
        $data = [
            'name'  => $name,
            'password'=>$password,
            'repwd'=>$repwd,
            'account'=>$account,
            'img'=>$img,
        ];   
        $validate = new Validate($rule, $msg);
        $result   = $validate->check($data);

        if(!$result){
            $this->error($validate->getError());
        }else{
            $password=md5($password);
            $data=
            [              
                'name'=>$name,
                'password'=>$password,
                'account'=>$account,
                'img'=>$img,
            ];

            $account=model('Account');
            $res=$account->addaccount($data);
    
            if($res){
                $this->success("添加管理员成功","admin/account/accountlist");
            }else{
                $this->error("添加管理员失败","admin/account/accountlist");
            }
        }
    }

    public function upimg(){
        $file = request()->file('img');     
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $imgurl="/uploads/".$info->getSaveName();
                echo $imgurl;
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
    public function del(){
        $admin_id=input('get.admin_id');
        $account=model('Account');
        $res=$account->del($admin_id);
        if($res){
            $this->success('删除成功','admin/account/accountlist');
        }else{
            $this->error('删除失败','admin/account/accountlist');
        }   
    }

    public function edit(){
        $admin_id=input('get.admin_id');
        $account=model('Account');
        $res=$account->edit($admin_id);
        $this->assign('admin',$res);
        return view('admin-accountedit');
    }
    public function edits(){
        $admin_id=input('get.admin_id');
        

        $name=input('post.name');
        $account=input('post.account');     
        $password=input('post.pwd');     
        $repwd=input('post.repwd');
        $imgs=input('post.imgs');
        $password=md5($password);
        $repwd=md5($repwd);
        
      
        $rule = [
            'name'=>'require',                   
        ];        
        $msg = [
            'name.require'=>'姓名不能为空',    
        ];        
        $data = array(
            'name'  => $name
        );   

        $rule['password']='require|confirm:repwd';
        $msg['password.require']='密码必须填写';
        $msg['password.confirm']='密码不一致';
        $data['password']=$password;
        $data['repwd']=$repwd;
        $data['img']=$imgs;      
        $validate = new Validate($rule, $msg);
        $result   = $validate->check($data);

        if(!$result){
            $this->error($validate->getError());
        }
        unset($data['repwd']);
        // dump($data);
        // exit;
        $account=model('Account');
        $res=$account->edits($admin_id,$data);
        
        if($res){
            $this->success('修改成功','admin/account/accountlist');
        }else{
            $this->error('修改失败','admin/account/accountlist');
        }  
    }
    
    
}
   
    
