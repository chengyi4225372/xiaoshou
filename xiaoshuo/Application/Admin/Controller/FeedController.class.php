<?php
namespace Admin\Controller;
use Think\Controller;
class FeedController extends CommonController {
	
	//记录
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
		if(!empty($_GET['user_id'])){
			$where['user_id'] = array('like','%'.$_GET['user_id'].'%');
		}
		$this->_list('feedback',$where,'create_time desc');
	}
}