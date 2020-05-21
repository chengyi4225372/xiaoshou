<?php
namespace Pay\Controller;
use Think\Controller;
class IndexController extends Controller {
	 public function _initialize(){
		 header("Content-type:text/html;charset=utf-8");
		// 从数据读取配置参数
		$config = M('config') -> select();
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = json_decode($v['value'],1);
			$_CFG[$v['name']] = $this -> $key;
		}

		$this -> assign('_CFG', $_CFG);
		$GLOBALS['_CFG'] = $_CFG;
		
		
		//当前域名
		$serviceUrl = $_SERVER['HTTP_HOST'];
		if($serviceUrl != $this->_site['url']){
			die("非法访问！");
		}
		
		
		//地址栏中必带sn和回调地址
		$sn = $_GET['sn'];
		$return_url = $_GET['return_url'];
		if(!$sn){
			die('非法访问！');
		}
		if(!$return_url){
			die('非法访问！');
		}
		
		$mp = array(
			"appid"=>$this->_site['appid'],
			"appsecret"=>$this->_site['appsecret'],
			"mch_id"=>$this->_site['mchid'],
			"key"=>$this->_site['mchkey'],
		);
		$this->_mp = $mp;
		
		
		$this -> return_url = urldecode($return_url);
		
		//充值表
		$this -> table = $_GET['table']?$_GET['table']:"charge";		
		$this -> order = M($this->table)->where(array('sn'=>$sn))->find();	
		$this -> user = M('user')->find(intval($this->order['user_id']));
		
		if(!session('?zopenid') && $this->user['mch']>0){
			$this->_auto_login();
		}
		//如果不是主站用户
		if($this->user['mch']>0){
			$mch = M('mch')->find($this->user['mch']);
			$this->openid = session('zopenid');
		}else{
			$this->openid = $this->user['openid'];
		}
		
		//支付订单的body说明
		$this->body = $mch['title']?$mch['title']:$this->_site['name'];
		
		$this->assign('titles',$this->body);
		
		$this->assign('order',$this->order);
		$this->assign('return_url',$this->return_url);
		$this->assign('title',$this->body.'充值支付');
		
	 }
	
	//处理支付
    public function index(){
		//微信支付
		$jsapi = new \Common\Util\wxjspay;
		$param = $this -> _mp;
		$param['appid'] = $this-> _mp['appid'];
		$param['mch_id'] = $this-> _mp['mch_id'];
		$param['key'] = $this -> _mp['key'];
		$param['openid'] = $this->openid;
		$param['body'] = $this->body.'在线充值';
		$param['out_trade_no'] = $this->order['sn'];
		$param['total_fee'] = $this->order['money'] * 100;
		$param['attach'] = json_encode(array(
				'order_id' => $this->order['id'],
				'table'	   => $this->table,
			));
		$param['notify_url'] = "http://".$_SERVER['HTTP_HOST'].__ROOT__.'/notify.php';
		$jsapi -> set_param($param);
		$uo = $jsapi -> unifiedOrder();
		$jsapi_params = $jsapi -> get_jsApi_parameters();
		$this -> assign('jsApiParameters', $jsapi_params);
		$this->display();
    }
	
	
	
	// 尝试自动登录
	private function _auto_login(){
		if(!isset($_GET['code'])){
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this -> _mp['appid']."&redirect_uri=".urlencode(get_current_url())."&response_type=code&scope=snsapi_userinfo&state=lswigcn#wechat_redirect";
			redirect($url);
			exit;
		}elseif($_GET['state'] == 'lswigcn'){
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this -> _mp['appid']."&secret=".$this -> _mp['appsecret']."&code=".$_GET['code']."&grant_type=authorization_code";
			
			$http = new \Common\Util\ddhttp;
			
			$rs = $http -> get($url);
			if(!$rs)$this -> error('获取OPENID失败');
			$rt = json_decode($rs, 1);
			if($rt['errcode'])$this -> error('授权失败:'.$rt['errmsg']);
			
			//缓存openid;
			session('zopenid',$rt['openid']);

			// 获取到了之后需要跳转一次，以去掉地址中的CODE和STATE
			unset($_GET['code']);
			unset($_GET['state']);
			redirect(U(null, $_GET));
			exit;
		}
	}
	
	
}?>