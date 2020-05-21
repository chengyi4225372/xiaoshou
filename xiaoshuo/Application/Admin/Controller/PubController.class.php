<?php
namespace Admin\Controller;
use Think\Controller;
class PubController extends Controller {
	public function _initialize(){
		// 从数据读取配置参数
		$config = M('config') -> select();
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = json_decode($v['value'],1);
		}
		
	}
	
	public function login(){
		if(IS_POST){
			$post = I('post.');
			if($post['name']!= $this->_user['name']){
				$this->error('账号错误！');
			}
			if(xmd5($post['pass']) != $this->_user['pass']){
				//$this->error('密码错误！');
			}

			if($_SESSION['admin_verify'] != strtolower($post['code']) ){
				$this->error('验证码错误！');
			}
			//当前域名
			$serviceUrl = $_SERVER['SERVER_NAME'];
			if($this->_site['url'] != $serviceUrl){
				//$this->error('非法访问！');
			}
			session('admin',$this->_user);
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
		session('admin',null);
		redirect(U("Pub/login"));
	}
}