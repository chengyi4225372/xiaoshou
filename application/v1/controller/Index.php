<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 17:39
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller {

   public function index(){

       return $this->fetch();
   }

    public function welcome(){

        return $this->fetch();
    }
    
}