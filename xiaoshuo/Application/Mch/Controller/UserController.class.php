<?php
namespace Mch\Controller;
use Think\Controller;
class UserController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['charge'])){
			if($_GET['charge'] == 1){
				$where['charge_total'] = array('gt',0);
			}else{
				$where['charge_total'] = 0;
			}
		}
		if(!empty($_GET['subscribe'])){
			if($_GET['subscribe'] == 1){
				$where['subscribe'] = 1;
			}else{
				$where['subscribe'] = 0;
			}
		}
		if(!empty($_GET['nickname'])){
			$where['nickname|id'] = array('like','%'.$_GET['nickname'].'%');
		}
		//dump($where);
		$where['mch'] = $this->mch['id'];
		$list = $this->_get_list("user",$where,'id desc');
		foreach($list as $k=>$v){
			$list[$k]['charge_total'] = M('charge')->where(array('user_id'=>$v['id'],'separate'=>1,'status'=>2))->sum('money');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	public function detail(){
		$id = I('get.id');
		$info = M('user')->find(intval($id));
		$this->assign('info',$info);
		//总获得阅读币
		$allmoney = M('finance')->where(array('user_id'=>$id,'action'=>array('in','1,2,4,5')))->sum('value');
		$this->assign('allmoney',$allmoney);
		//总消耗阅读币
		$allmoney = M('finance')->where(array('user_id'=>$id,'action'=>3))->sum('value');
		$this->assign('usemoney',$usemoney);
		
		//数据
		$type = I('get.type')?I('get.type'):1;
		
		if($type == 1 ){ //充值数据
			if($_GET['status']){
				$where['status'] = $_GET['status'];
			}
			$where['user_id'] = $id;
			$where['mch'] = $this->mch['id'];
			$where['separate'] = 1;
			$list = $this->_get_list('charge',$where,'create_time desc');
			foreach($list as $k=>$v){
				$list[$k]['name'] = M('anime')->where(array('id'=>$v['anid']))->getField('title');
			}
		}elseif($type == 2){//消费
			$list = $this->_get_list('finance',array('user_id'=>$id,'action'=>3),'create_time desc');
			foreach($list as $k=>$v){
				$list[$k]['name'] = M('anime')->where(array('id'=>$v['anid']))->getField('title');
				$list[$k]['chapsname'] = M('anime_chapter')->where(array('anid'=>$v['anid'],'chaps'=>$v['chaps']))->getField('title');
			}
		}elseif($type == 3){//签到
			$list = $this->_get_list('sign',array('user_id'=>$id),'create_time desc');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
}