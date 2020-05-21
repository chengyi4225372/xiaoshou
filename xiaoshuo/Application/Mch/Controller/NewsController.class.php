<?php
namespace Mch\Controller;
use Think\Controller;
class NewsController extends CommonController {
   
	public function index(){
		$where['mch'] = $this->mch['id']?$this->mch['id']:0;
		$where['aid'] = I('get.aid');
		
		$this -> assign('info',M('autoreply')->find(intval(I('get.aid'))));
		
		$this -> _list('news',$where,'id desc');
	}
	
	
	// 编辑、添加图文
	public function edit(){
		if(IS_POST){
			if(!isset($_GET['id']))
				$_POST['create_time'] = NOW_TIME;
			
			if(isset($_GET['aid'])){
				$_POST['aid'] = intval($_GET['aid']);
			}
		}
		$this -> _edit('news', U('index?aid='.$_GET['aid']));
	}
	
}