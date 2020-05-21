<?php
namespace Admin\Controller;
use Think\Controller;
class PromoterController extends CommonController {
   
	public function index(){
		$this -> _list('promoter',$where,'id desc');
	}
	
	public function edit(){
		if(IS_POST){
			$_POST['tpass'] = $_POST['pass'];
			$_POST['pass'] = xmd5($_POST['pass']);
			if(!$_GET['id']){
				$_POST['create_time'] = time();
			}
			if(!$_POST['url']){
				$urlArr = explode('.',$this->_site['url']);
				$_POST['url'] = $_POST['appid'].".".$urlArr[1].".".$urlArr[2];
			}
		}
		$this->_edit('mch',U('index'));
	}
	
	//更新状态
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('mch')->find(intval($id));
			if($info['status'] == -2){
				$status = 1;
			}else{
				$status = $info['status']?0:1;
			}
			M('mch')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->success('更新成功！');
		}else{
			$this->error('非法请求！');
		}
	}
}