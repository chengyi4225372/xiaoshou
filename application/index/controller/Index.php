<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\index\Controller\Base;
class Index extends Base
{
    //首页
    public function index()
    {
         $goodslist = Db::name('goods')->where(['status'=>1])->select();
         $this->assign('list',$goodslist);
         return $this->fetch();
    }




}
