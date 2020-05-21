<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if($_GET['title']){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$this -> _list('article',$where,'id desc');
	}
	
	public function edit(){
		if(IS_POST){
			if(!$_GET['id']){
				$_POST['create_time'] = time();
			}
		}
		$this->_edit('article',U('index'));
	}
	
	
}