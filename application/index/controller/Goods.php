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
    //商品首页
    public function index()
    {
        $list = Db::name('card')->where(['mid'=>session('member.id'),'status'=>1])->select();
        foreach ($list as $k=>$v){
            $list[$k]['goods']= Db::name('goods')->where(['id'=>$list[$k]['gid'],'status'=>1])->find();
            $list[$k]['totalmoney'] = floatval($v['dan']) * floatval($v['counts']);
        }
        $money = Db::name('card')->where(['mid'=>session('member.id'),'status'=>1])->field('dan,counts')->select();
        foreach ($money as $key =>$val){
            
        }

        dump($money);
        exit();
        
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * @return mixed
     * 订单地址
     */
    public function address(){
        return $this->fetch();
    }

    /**
     * @return mixed
     * 订单详情
     */
    public function order(){
        return $this->fetch();
    }

    /**
     * @return mixed
     * 支付页面
     */
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

    /**
     * 移动出单个购物车
     */
    public function delgoods(){
        if($this->request->isGet()){
            $gid = input('get.gid');
            if(empty($gid) || !isset($gid)){
                return false;
            }
            $ret = Db::name('card')->where(['id'=>$gid])->update(['status'=>0]);

            if($ret !== false){
                return json(['code'=>200,'msg'=>'移除成功']);
            }else{
                return json(['code'=>400,'msg'=>'移除失败']);
            }
        }
        return false;
    }

    /**
     * 清空购物车
     */
     public function qing(){
           if($this->request->isGet()){
               $mid = input('get.mid');
           }

         if(empty($mid) || !isset($mid)){
             return false;
         }
         $ret = Db::name('card')->where(['mid'=>$mid])->update(['status'=>0]);

         if($ret !== false){
             return json(['code'=>200,'msg'=>'清空成功']);
         }else{
             return json(['code'=>400,'msg'=>'清空失败']);
         }
     }

}