<?php
namespace Admin\Controller;
use Think\Controller;
class ChargeController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['create_time'] = array(
				array('gt', strtotime($_GET['time1'])),
				array('lt', strtotime($_GET['time2']) + 86400)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['create_time'] = array('gt', strtotime($_GET['time1']));
		}
		elseif(!empty($_GET['time2'])){
			$where['create_time'] = array('lt', strtotime($_GET['time2'])+86400);
		}
		$where['status'] = 2;
		$list = $this -> _get_list('charge',$where,'create_time desc');
		foreach($list as $k=>$v){
			$list[$k]['user'] = M('user')->find(intval($v['user_id']));
			$list[$k]['mch'] = M('mch')->find(intval($v['mch']));
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
}