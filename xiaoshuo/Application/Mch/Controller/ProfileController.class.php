<?php
namespace Mch\Controller;
use Think\Controller;
class ProfileController extends CommonController {
   
	public function index(){
		$this -> display();
	}
	

	public function ePass(){
		if(IS_POST){
			$post = I('post.');
			if(xmd5($post['oldpassword']) != $this->mch['pass']){
				$this->error('当前密码错误！');
			}
			if($post['newpassword'] != $post['newpassworded']){
				$this->error('两次新密码不一致！');
			}
			M('mch')->where(array('id'=>$this->mch['id']))->save(array('pass'=>xmd5($post['newpassword']),'tpass'=>$post['newpassword']));
			session('mch',null);
			$this->success('修改成功！',U('Pub/login'));
			exit;
		}
		$this -> display();
	}
	
	
	//模板选择
	public function tpl(){
		if(IS_POST){
			$tpl = I('post.tpl');
			$info = M('tpl')->where(array('mch'=>$this->mch['id']))->getField('tpl');
			if(!$info){
				M('tpl')->add(array(
					"mch"=>$this->mch['id'],
					"tpl"=>$tpl,
				));
			}else{
				M('tpl')->where(array('mch'=>$this->mch['id']))->save(array('tpl'=>$tpl));
			}
			$this->success('设置成功！');
			exit;
		}
		$tpl = M('tpl')->where(array('mch'=>$this->mch['id']))->getField('tpl');
		if(!$tpl){
			$tpl = 1;
		}
		$this->assign('tpl',$tpl);
		$this->display();
	}
}