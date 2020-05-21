<?php
namespace Pay\Controller;
use Think\Controller;
class AlipayController extends Controller {
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
		$serviceUrl = $_SERVER['SERVER_NAME'];
		if($serviceUrl != $this->_site['url']){
			die("非法访问！");
		}
		
		
		//地址栏中必带sn和回调地址
		$sn = $_GET['sn'];
		$return_url = $_GET['return_url'];
		if(!$sn){
			//die('非法访问！');
		}
		if(!$return_url){
			//die('非法访问！');
		}
		
		$this -> return_url = urldecode($return_url);
		
		//充值表
		$this -> table = $_GET['table']?$_GET['table']:"charge";		
		$this -> order = M($this->table)->where(array('sn'=>$sn))->find();	
		$this -> user = M('user')->find(intval($this->order['user_id']));

		//如果不是主站用户
		if($this->user['mch']>0){
			$mch = M('mch')->find($this->user['mch']);
		}
		
		//支付订单的body说明
		$this->body = $mch['title']?$mch['title']:$this->_site['name'];
		$this->body = $this->body.'在线支付';

		$this->assign('order',$this->order);
		$this->assign('return_url',$this->return_url);
		
		$this->assign('titles',$this->body);
		
	 }
	
	//处理支付
    public function index(){
		// 微信环境提示用浏览器打开
		if(IS_WECHAT){
			$this -> display();
			exit;
		}
		$parameter = array(
			"service"       => 'alipay.wap.create.direct.pay.by.user',
			"partner"       => $this -> _site['alipaypid'],
			"seller_id"  	=> $this -> _site['alipaypid'],
			"payment_type"	=> 1,
			"notify_url"	=> complete_url('/Alipaynotify.php'),
			"return_url"	=> $this->return_url,
			"anti_phishing_key"=> '',
			"exter_invoke_ip"=> '',
			"out_trade_no"	=> $this->order['sn'],
			"subject"	=> $this -> body,
			"total_fee"	=> $this->order['money'],
			"body"	=> '',
			"_input_charset"	=> strtolower('utf-8')	
		);
		$alipay_config = array(
			'pid'=>$this->_site['alipaypid'],
			'key'=>$this->_site['alipaykey'],
		);
		$alipay_config['sign_type'] = strtoupper('MD5');
		
		$alipay = new \Common\Util\Alipay\AlipaySubmit($alipay_config);
		$html_text = $alipay->buildRequestForm($parameter,"get", "确认");
		echo $html_text;
    }
	
	
}?>