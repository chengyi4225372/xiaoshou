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
        return $this->fetch();
    }




}
