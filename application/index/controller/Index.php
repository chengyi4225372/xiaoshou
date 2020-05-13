<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    //首页
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 新闻列表
     */
    public function news()
    {
        return $this->fetch();
    }

    /**
     * 联系我们
     */
    public function contact()
    {
        return $this->fetch();
    }

    /**
     * 党建工作
     */
    public function works()
    {
        return $this->fetch();
    }

    /**
     * 服务实施
     */
    public function service()
    {
        return $this->fetch();
    }

    /**
     * 经营范围
     */
    public function rands()
    {
     return $this->fetch();
    }

    /**
     * 企业文化
     */
    public function qiye()
    {
        return $this->fetch();
    }


    /**
     * 人力资源
     */
    public function resource()
    {
        return $this->fetch();
    }

    /**
     * 中燃大连
     */
    public function zrdl()
    {
        return $this->fetch();
    }
}
