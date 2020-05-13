<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 17:37
 */
namespace app\v1\controller;

use think\Controller;

class Login extends Controller {

    /**
     * @return bool|mixed\
     * 登录
     */
    public function index(){
        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){

        }

        return false;
    }


    public function loginout(){
        if($this->request->isGet()){

        }
        return false;
    }




}