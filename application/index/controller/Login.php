<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 19:20
 */
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Login extends Controller{

    /**
     * @return bool
     * 登录
     */
    public function login(){
        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){
             $user = input('post.user','','trim');
             $pwd  = input('post.pwd','','trim');
             $ret = Db::name('member')->whereOr(['users'=>$user,'tel'=>$user,'email'=>$user])->find();
             if(empty($ret) || !isset($ret)){
                 return json(['code'=>402,'msg'=>'该用户不存在']);
             }
             if($ret['pwd'] != md5($pwd)){
                 return json(['code'=>400,'msg'=>'密码错误']);
             }
             session('member',$ret);
             return json(['code'=>200,'msg'=>'登陆成功']);
        }

        return false;
    }

    /***
     * @return mixed
     * 注册
     */
    public function reg(){
        if($this->request->isPost()){
             $data['users'] = input('post.user','','trim');
             $data['pwd']  = md5(input('post.pwd','','trim'));
             $data['email']  = input('post.email','','trim');
             $data['tel']  = input('post.tel','','trim');
             $data['region']  = input('post.region','','trim');
             $data['create_time']  = time();

             $ret = Db::name('member')->insertGetId($data);

             if($ret !== false){
                 return json(['code'=>200,'msg'=>'注册成功']);
             }else{
                 return json(['code'=>400,'msg'=>'注册失败']);
             }
        }
        return $this->fetch();
    }

    /**
     * @return bool|void
     * 退出
     */
    public function loginout(){
        if($this->request->isGet()){
            $ret = session('member',null);
            if($ret !== false){
                return $this->redirect('index/index');
            }
        }
        return false;
    }
}