<?php
namespace Admin\Controller;
use Think\Controller;
class JoinusController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if($_GET['mobile']){
			$where['mobile'] = array('like','%'.$_GET['mobile'].'%');
		}
		if($_GET['status']){
			$where['status'] = intval($_GET['status']);
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

		$list = $this->_get_list('joinus',$where,'create_time desc');

		foreach($list as $k=>$v){
			$list[$k]['mchtitle'] = M('mch')->where(array('id'=>$v['mch']))->getField('name');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
}