<?php
namespace Homee\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
		
		header("Content-type: text/html; charset=utf-8");
	
		// 如果是手机访问则跳转到手机
		if(IS_MOBILE || is_weixin()){
			redirect(U("Home/".CONTROLLER_NAME."/".ACTION_NAME,$_GET));
			exit;
		}
		
		// 从数据读取配置参数
		$config = M('config') -> select();
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = json_decode($v['value'],1);
			$_CFG[$v['name']] = $this -> $key;
		}

		$this -> assign('_CFG', $_CFG);
		$GLOBALS['_CFG'] = $_CFG;
		
		if($serviceUrl == $this->_site['url']){
			//网站名称
			$this->assign('title',$this->_site['name']);
			//公众号二维码地址
			$this->assign('qrcode',$this->_site['qrcode']);
		}else{
			$mch = M('mch')->where(array('url'=>$serviceUrl))->find();
			//网站名称
			$this->assign('title',$mch['title']);
			//公众号二维码地址
			$this->assign('qrcode',$mch['qrcode']);
		}
		$this->assign('mch',$mch);
	}	
}