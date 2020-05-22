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

    public function login(){
        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){

        }

        return false;
    }


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
}