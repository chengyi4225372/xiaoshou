<?php
namespace Admin\Controller;
use Think\Controller;
class AutoreplyController extends CommonController {
   
	public function index(){
		$where['mch'] = $this->mch['id']?$this->mch['id']:0;
		$this -> _list('autoreply',$where,'id desc');
	}
	
	
	// 编辑、添加关键词
	public function edit(){
		if(IS_POST){
			if(empty($_POST['keyword'])){
				$this -> error('关键词不能为空');
			}
			$_POST['mch'] = $this->mch['id']?$this->mch['id']:0;
		}
		$this -> _edit('autoreply', U('index'));
	}
	
	
	
	//更新状态
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('autoreply')->find(intval($id));
			$status = $info['status']?0:1;
			M('autoreply')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->success('更新成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	
}