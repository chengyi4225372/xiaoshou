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
  protected  $table ='member';

    public function index(){
        $data = Db::name($this->table)->order('id desc')->paginate(15);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function edit(){
        if($this->request->isGet()){
            $mid = input('get.mid','','int');
            if(empty($mid) || !isset($mid)){
                return false;
            }
            $infos = Db::name($this->table)->where('id',$mid)->find();
            $this->assign('infos',$infos);
            return $this->fetch();
        }
        return  false;
    }

}