<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/22
 * Time: 15:21
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;

class Users extends Base {

    public function index(){

        return $this->fetch();
    }

    public function welcome(){

        return $this->fetch();
    }

}