<?php
namespace Admin\Controller;
use Think\Controller;
class VideoController extends CommonController {
   

	//列表
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}

		$this->_list("video",$where,'id desc');
	}
	
	
	//编辑和添加
	public function edit(){
		if(IS_POST){
			if($_POST['cateids']){
				$_POST['cateids'] = implode(',',$_POST['cateids']);
			}
			if($_POST['areas']){
				$_POST['areas'] = implode(',',$_POST['areas']);
			}
			if(!$_POST['id']){
				$_POST['create_time'] = time();
			}
		}
		$this->_edit('video');
	}
	
	//更新状态
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('video')->find(intval($id));
			$status = $info['status']?0:1;
			M('video')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
}