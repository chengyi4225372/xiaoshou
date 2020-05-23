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
use app\index\Controller\Base;

class Goods extends Base
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
        if($this->request->isGet()){
            $mid = input('get.gid');
            if(empty($mid) || !isset($mid)){
                return false;
            }

            $info = Db::name('goods')->where(['status'=>1,'id'=>$mid])->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
        return false;
    }

    /**
     * 购物车
     */
    public function addcard(){
        if($this->request->isPost()){
            $data['mid'] = input('post.mid');
            $data['gid'] = input('post.gid');
            $data['dan'] = input('post.dan');
            $data['counts'] = input('post.counts');

            $ret = Db::name('card')->insert($data);

            if($ret !== false){
                return json(['code'=>200,'msg'=>'加入购物车']);
            }else{
                return json(['code'=>400,'msg'=>'未能加入购物车']);
            }

        }
        return false;
    }
}