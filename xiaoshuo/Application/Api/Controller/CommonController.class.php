<?php
namespace Api\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize(){
		// 从数据读取配置参数
		$config = M('config') -> select();
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = json_decode($v['value'],1);
			$_CFG[$v['name']] = $this -> $key;
		}

		$this -> assign('_CFG', $_CFG);
		$GLOBALS['_CFG'] = $_CFG;
		
    }
	//返回成功
	public function _appSuccMsg($msg="",$ErrMsg = ""){
		header("Content-type:text/html;charset=utf-8");
		echo json_encode(array(
			'result'=>"success",
			'errMsg'=>$ErrMsg,
			'body'=>$msg,
		));
		exit;
	}
	
	//返回失败
	public function _appErrMsg($msg){
		header("Content-type:text/html;charset=utf-8");
		echo json_encode(array(
			'result'=>"error",
			'errMsg'=>$msg,
		));
		exit;
	}
	
	//检测参数传入
	public function checkPost($post){
		if(empty($post) || !$post){
			$this->_appErrMsg('参数丢失！');
		}else{
			foreach($post as $k=>$v){
				if($k != "device_id"){
					if($v == "" || !$v){
						$this->_appErrMsg('参数丢失！');
						break;
					}
				}
			}
		}
	}
	
	
}