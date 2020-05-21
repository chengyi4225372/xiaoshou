<?php
namespace Mch\Controller;
use Think\Controller;
class PubController extends Controller {
	public function _initialize(){
		// 从数据读取配置参数
		$config = M('config') -> select();
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = json_decode($v['value'],1);
		}
		$this -> assign('_CFG', $_CFG);
		$GLOBALS['_CFG'] = $_CFG;
		
	}
	
	public function login(){
		if(IS_POST){
			$post = I('post.');
			$mch = M('mch')->where(array('username'=>$post['name'],'pass'=>xmd5(trim($post['pass']))))->find();
			if(empty($mch) || !$mch){
				$this->error('账号或密码错误！');
			}
			if($_SESSION['admin_verify'] != strtolower($post['code']) ){
				$this->error('验证码错误！');
			}
			//当前域名
		
			$serviceUrl = $_SERVER['HTTP_HOST'];
			if($mch['url'] != $serviceUrl && $mch['type'] == 1){
				$this->error('非法访问！');
			}
			
		
			
			if($mch['status'] == 0){
				$this->error('您的账号被禁用！');
			}
			if($mch['status'] == -2){
				$this->error('您的账号正在审核中！');
			}
			session('mch',$mch);
			$this->success('',U('Index/index'));
		}
		$this -> display();
	}
	
	/* 生成验证码 */
    public function verify(){
		$im = new \Common\Util\ValidateCode;
		$im->doimg();
		$_SESSION['admin_verify'] = $im->getCode();
    }

	
	/* 验证码校验 */
    private function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
		$res = $verify->check($code, $id);
        return $res;
    }
	
	
	//退出
	public function logout(){
		session('mch',null);
		redirect(U("Pub/login"));
	}
}