<?php
namespace app\admin\controller;
// use app\admin\controller\Common;
use \think\Controller;
use \think\Validate;
use \think\Config;

class Account extends Common
{

    public function accountList(){
        return view('admin-accountlist');
    }
    public function accountData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $res = model('account')->accountData($page,$limit);
        echo json_encode($res);
    }
    public function accountAdd(){
        if ($this->request->isPost()){
            $data = $this->request->post();
            $rule = [
                'name|用户名'   => 'require|unique:admin',
                'user|账户'   => 'require|min:3|max:15|alphaNum|unique:admin',
                'password|密码' => 'confirm|min:6|max:20|alphaDash',
            ];
            $msg = [
                'name.require'      => '用户名必须填写',
                'name.unique'       => '用户名已注册',

                'user.require'      => '账户必须填写',
                'user.min'          => '账户最少要3个字符',
                'user.max'          => '账户最多不能超过15个字符',
                'user.alphaNum'     => '账户只能由字母和数字组成',
                'user.unique'       => '账户已注册',

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
                        'user'=>$data['user'],
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
    public function accountEdit(){
        $id = $this->request->get('id');
        $res = model('account')->accountFind($id);
        if ($this->request->isPost()){
            $data = $this->request->post();
            $rule = [
                'name|用户名'   => 'require',
                'user|账户'   => 'require|min:3|max:15|alphaNum',
                'password|密码' => 'confirm|min:6|max:20|alphaDash',
            ];
            $msg = [
                'name.require'      => '用户名必须填写',

                'user.require'      => '账户必须填写',
                'user.min'          => '账户最少要3个字符',
                'user.max'          => '账户最多不能超过15个字符',
                'user.alphaNum'     => '账户只能由字母和数字组成',

                'password.confirm'  => '密码必须一致',
                'password.min'      => '密码至少6个字符',
                'password.max'      => '密码最多不能超过20个字符',
                'password.alphaDash'=> '密码只能由字母和数字，_和-组成',
            ];
            $validate = new Validate($rule, $msg);
            $result   = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }else {
                $data['password'] = md5($data['password']);
                $admin = [
                    'name' => $data['name'],
                    'user' => $data['user'],
                    'password' => $data['password'],
                ];
                $res = model('Account')->accountEdit($id,$admin);
                if ($res) {
                    $this->success("修改管理员成功", "/admin/account/accountList");
                } else {
                    $this->error("修改管理员失败", "/admin/account/accountList");
                }
            }
        }
        $this->assign('user',$res);
        return view('admin-accountedit');
    }
    public function accountDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('Account')->accountDel($idlist);
        if($res){
            $this->success('删除成功','admin/account/accountlist');
        }else{
            $this->error('删除失败','admin/account/accountlist');
        }
    }
    public function accountStatus(){
        $id = input('get.id');
        $res = model('Account')->accountStatus($id);
        if($res){
            return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
        }else{
            return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
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


    public function groupList(){
        return view('admin-grouplist');
    }
    public function groupData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $res = model('Account')->groupData($page,$limit);
        echo json_encode($res);
    }
    public function groupAdd(){
        if ($this->request->isPost()){
            $data = $this->request->post();
            $rule = [
                'name|名称'   => 'require|unique:group',
            ];
            $msg = [
                'name.require'      => '名称必须填写',
                'name.unique'       => '名称已注册',
            ];
            $validate = new Validate($rule, $msg);
            $result   = $validate->check($data);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $res=model('Account')->groupAdd($data);
                if($res){
                    $this->success("添加分组成功","/admin/account/groupList");
                }else{
                    $this->error("添加分组失败","/admin/account/groupList");
                }
            }
        }
        return view('admin-groupadd');
    }
    public function groupEdit(){
        $id = $this->request->get('id');
        $res = model('account')->groupFind($id);
        if ($this->request->isPost()){
            $data = $this->request->post();
            $res=model('Account')->groupEdit($data);
            if($res){
                $this->success("修改分组成功","/admin/account/groupList");
            }else{
                $this->error("修改分组失败","/admin/account/groupList");
            }
        }
        $this->assign('group',$res);
        return view('admin-groupedit');
    }
    public function groupDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('Account')->groupDel($idlist);
        if($res){
            $this->success('删除成功','admin/account/accountlist');
        }else{
            $this->error('删除失败','admin/account/accountlist');
        }
    }
    public function groupStatus(){
        $id = input('get.id');
        $res = model('Account')->groupStatus($id);
        if($res){
            return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
        }else{
            return ['data'=>$res,'code'=>0,'message'=>'操作失败'];
        }
    }


    public function recordList(){
        return view('admin-record');
    }
    public function recordData(){
        $limit = trim(input('limit'));
        $offset = trim(input('offset'));
        $page = floor($offset / $limit) + 1;
        # 获取并且计算 页号 分页大小
        $list = db('admin_record')->alias('r')
            ->join('admin a',"a.id = r.aid",'right')
            ->join('group g',"g.id = a.group_id",'right')
            ->where('r.id>0')
            ->field('r.id,r.aid,r.time,r.ip,r.area,a.name,a.user,a.group_id,g.name as groups')
            ->order('r.time desc')
            ->page($page,$limit)
            ->select();
//        $list = db('admin_record')->page($page,$limit)->select();
        # 查询相关数据
        $count = db('admin_record')->count();
        # 查询数据条数
        $ret = [
            'rows' => $list,
            'total' => $count,
        ];
        echo json_encode($ret);
    }
//    删除记录
    public function recordDel(){
        $idlist = array_filter(explode(',', input('idlist')));
        $res = model('Account')->recordDel($idlist);
        return ['data'=>$res,'code'=>1,'message'=>'操作完成'];
    }
}
   
    
