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
        return $this->fetch();
    }
}