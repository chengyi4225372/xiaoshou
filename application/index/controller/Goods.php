<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/21 0021
 * Time: 15:15
 * 购物车
 */
namespace app\index\Controller;
use think\Controller;
use think\Db;

class Goods extends Controller
{
    //首页
    public function index()
    {
        return $this->fetch();
    }


    public function address(){
        return $this->fetch();
    }

    public function order(){
        return $this->fetch();
    }


    public function succ(){
        return $this->fetch();
    }


    /**
     * 商品详情
     */
    public function ginfo(){
        return $this->fetch();
    }
}