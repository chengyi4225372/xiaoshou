<?php
namespace Pay\Controller;
use Think\Controller;
class PaysapiController extends Controller {
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
		if(!$sn && !IS_POST){
			die('非法访问！');
		}
		if(!$return_url && !IS_POST){
			die('非法访问！');
		}

		$this -> table = $_GET['table']?$_GET['table']:"charge";		
		$this -> order = M($this->table)->where(array('sn'=>$sn))->find();	
		$this -> return_url = urldecode($return_url);
		$this -> user = M('user')->find(intval($this->order['user_id']));
		
		$this->assign('order',$this->order);
		$this->assign('return_url',$this->return_url);
		
		$mch = M('mch')->find(intval($this->order['mch']));
		//支付订单的body说明
		$this->body = $mch['title']?$mch['title']:$this->_site['name'];
		$this->assign('titles',$this->body);
		
	}
	
	//处理支付
    public function index(){
		$url = "https://pay.bbbapi.com/?format=json";
		$data = array(
			'uid'=>$this->_site['paysuid'],
			'price'=> $this->order['money'],
			'istype'=>2,
			'notify_url'=>"http://".$_SERVER['HTTP_HOST'].__ROOT__."/paysNotify.php",
			'return_url'=>"http://".$_SERVER['HTTP_HOST'].__ROOT__."/paysReturn.php",
			'orderid'=>$this->order['sn'],
			'orderuid'=>$this->table,
			'goodsname'=>"在线充值",
		);
		$str = $data['goodsname'].$data['istype']. $data['notify_url'] . $data['orderid'] . $data['orderuid'] . $data['price'] . $data['return_url'] . $this->_site['paystoken'] . $this->_site['paysuid'];
		$data['key'] = md5($str);
		$return = http($url,$data);

		$json = json_decode($return,1);
		if($json['data']['qrcode']){
			$this->assign('qrcode',$json['data']['qrcode']);
			$this->display();
		}else{
			die($json['msg']);
		}
    }
	
	
	//ajax查询订单状态
	public function getChargeStatus(){
		if(IS_POST){
			$sn = I('post.sn');
			$charge = M('charge')->where(array('sn'=>$sn))->find();
			if($charge['status'] == 2){
				$this->success('支付成功！',$this->return_url);
			}else{
				$this->error("还未支付！");
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
}?>