<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/22
 * Time: 17:38
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;

class Sale extends Base {

    public function index(){

        return $this->fetch();
    }

    public function add(){
        if($this->request->isPost()){

        }

        return $this->fetch();
    }

    public function edit(){
        if($this->request->isPost()){

        }

        return $this->fetch();
    }


    public function del(){
        if($this->request->isGet()){

        }
    }

}