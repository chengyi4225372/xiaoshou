<?php
namespace Admin\Controller;
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

		$list = $this->_get_list("user",$where,'id desc');
		foreach($list as $k=>$v){
			$list[$k]['mname'] = M('mch')->where(array('id'=>$v['mch']))->getField('title');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//设置金额
	public function setUserMoney(){
		if(IS_POST){
			$user_id = I('post.user_id');
			$money = I('post.money');
			M('user')->where(array('id'=>$user_id))->save(array(
				'money' => array('exp', 'money+'.$money),
			));
			flog($user_id,'money',$money, 4); // 记录财务日志
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	//设置VIP
	public function setUserVip(){
		if(IS_POST){
			$user_id = I('post.user_id');
			$vip = I('post.vip');
			if($vip == 1){
				$time = strtotime("+1 year");
				$usave = array(
					'viptime' => array('exp', 'viptime+'.$time),
				);
			}elseif($vip == 2){
				$usave = array( //viptime = -1 
					'viptime' => -1,
				);	
			}
			M('user') -> where(array('id'=>$user_id)) -> save($usave);
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	//设置密码
	public function setUserPsw(){
		if(IS_POST){
			$user_id = I('post.user_id');
			$psw = I('post.psw');
			$usave = array('psw'=>md5($psw));
			M('user') -> where(array('id'=>$user_id)) -> save($usave);
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
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
			$list = $this->_get_list('charge',$where,'create_time desc');
			foreach($list as $k=>$v){
				$list[$k]['name'] = M('anime')->where(array('id'=>$v['anid']))->getField('title');
			}
		}elseif($type == 2){//消费
			$list = $this->_get_list('finance',array('user_id'=>$id,'action'=>3),'create_time desc');
			foreach($list as $k=>$v){
				$list[$k]['name'] = M('anime')->where(array('id'=>$v['anid']))->getField('title');
			}
		}elseif($type == 3){//签到
			$list = $this->_get_list('sign',array('user_id'=>$id),'create_time desc');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
}