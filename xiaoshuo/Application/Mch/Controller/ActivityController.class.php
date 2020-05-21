<?php
namespace Mch\Controller;
use Think\Controller;
class ActivityController extends CommonController {
   
	public function index(){
		$this -> assign('nowtime',time());
		$list = $this -> _get_list('mch_activity',array('status'=>1,'mch'=>$this->mch['id']),'create_time desc');
		$this -> assign('list',$list);
		$this -> assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//更新状态
	public function setShow(){
		if(IS_POST){
			$id = I('post.id');
			$field = I('post.field');
			$info = M('mch_activity')->find(intval($id));
			$isshow = $info['isshow']?0:1;
			M('mch_activity')->where(array('id'=>$id))->save(array('isshow'=>$isshow));
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	
}