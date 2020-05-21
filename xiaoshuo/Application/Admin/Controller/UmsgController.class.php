<?php
namespace Admin\Controller;
use Think\Controller;
class UmsgController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if($_GET['title']){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$this -> _list('umsg',$where,'create_time desc');
	}
	
	public function edit(){
		if(!isset($_GET['id'])){
			$_POST['create_time'] = NOW_TIME;
		}
		$this -> _edit('umsg', U('index'));
	}
	
	
}