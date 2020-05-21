<?php
namespace Pay\Controller;
use Think\Controller;
class NotifyController extends Controller {
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
		//当前域名
		$serviceUrl = $_SERVER['SERVER_NAME'];
		if($serviceUrl != $this->_site['url']){
			die("非法访问！");
		}
		
		$mp = array(
			"appid"=>$this->_site['appid'],
			"appsecret"=>$this->_site['appsecret'],
			"mch_id"=>$this->_site['mchid'],
			"key"=>$this->_site['mchkey'],
		);
		$this->_mp = $mp;
	}
    
	// 支付通知异步页面
	public function index(){
		header("Content-type:text/html;charset=utf-8");
		$jsapi = new \Common\Util\wxjspay;
		$jsapi -> set_param('key', $this -> _mp['key']);
		
		// 验证签名之前必须调用get_notify_data方法获取数据
		$data = $jsapi -> get_notify_data();
		if(!$jsapi->check_sign()){
			// 签名验证失败
			die('FAIL');
		}

		if($data['return_code'] != 'SUCCESS' || $data['result_code'] != 'SUCCESS'){
			die('FAIL');
		}
		
		$attach = json_decode($data['attach'], 1);
		$order_id = intval($attach['order_id']);
		$table = $attach['table'];
		

		// 查询此支付是否已处理
		if(M('pay_log') -> where(array('transaction_id' => $data['transaction_id'])) -> find()){
			die('SUCCESS');
		}else{
			$data['log_time'] = NOW_TIME;
			// 记录支付日志
			M('pay_log') -> add($data);
		}
		
		//订单信息
		$order_info = M($table)->find(intval($order_id));
		// 获取用户信息，异步通知不执行网页认证授权，需要获取用户信息
		$this -> user = M('user') -> find(intval($order_info['user_id']));
		if(!$this -> user){
			die('Fail');
		}
		if($order_info['status'] !=1){
			die('SUCCESS');
		}		
		$paid_fee = $data['total_fee']/100;
		$money = $order_info['money'];
		// 已支付全部费用
		if($paid_fee >= $money){
			
			$save['status'] = 2;
			$save['pay_time'] = NOW_TIME;
			M($table) -> where(array('id'=>$order_id)) -> save($save);
			
			//普通充值
			if($table == "charge"){
				if($order_info['ishalf'] == 1){ //判断是否包半年
					if($this->user['viptime']>0){//如果已经包年
						$time = strtotime('+6 month',$this->user['viptime']);
						$usave = array(
							'viptime' => $time,
							'charge_total'=>array('exp','charge_total+'.$order_info['money']),
						);
					}
					if($this->user['viptime'] == 0){
						$time = strtotime('+6 month');
						$usave = array(
							'viptime' => array('exp', 'viptime+'.$time),
							'charge_total'=>array('exp','charge_total+'.$order_info['money']),
						);
					}
					
				}elseif($order_info['isyear'] == 1){//判断是否包年
					if($this->user['viptime']>0){//如果已经包年
						$time = strtotime('+1 year',$this->user['viptime']);
						$usave = array(
							'viptime' => $time,
							'charge_total'=>array('exp','charge_total+'.$order_info['money']),
						);
					}
					if($this->user['viptime'] == 0){
						$time = strtotime("+1 year");
						$usave = array(
							'viptime' => array('exp', 'viptime+'.$time),
							'charge_total'=>array('exp','charge_total+'.$order_info['money']),
						);
					}
					
				}elseif($order_info['isover'] == 1){//判断是否包终生
					$usave = array( //viptime = -1 
						'viptime' => -1,
						'charge_total'=>array('exp','charge_total+'.$order_info['money']),
					);				
				}else{
					$total = $order_info['money']*$order_info['lv'] + $order_info['smoney']*$order_info['lv'];
					$usave = array(
						'money' => array('exp', 'money+'.$total),
						'charge_total' => array('exp', 'charge_total+'.$money),
					);
				}
				if($usave){
					M('user') -> where(array('id'=>$this->user['id'])) -> save($usave);
				}
				

				//判断是否有推广链接
				if($order_info['chapter']>0){
					M('chapter')->where(array('id'=>$order_info['chapter']))->save(array(
						'charge' => array('exp', 'charge+'.$order_info['money']),
					));
				}			
					
				//查询是否有分成
				$separate = M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1,'type'=>1))->select();
				if($separate){
					foreach($separate as $v){
						M('mch')->where(array('id'=>$v['pmch']))->save(array(
							'money' => array('exp', 'money+'.$v['money']),
						));
					}
					 M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1,'type'=>1))->save(array('status'=>2));
				}
				
				flog($this -> user['id'],'money',$data['total_fee']/100, 1); // 记录财务日志
				
			}elseif($table == "activity_buy"){
				$total = $order_info['money']*$order_info['lv'] + $order_info['smoney']*$order_info['lv'];
				$usave = array(
					'money' => array('exp', 'money+'.$total),
					'charge_total' => array('exp', 'charge_total+'.$money),
				);
				if($usave){
					M('user') -> where(array('id'=>$this->user['id'])) -> save($usave);
				}
				
				//查询是否有分成
				$separate = M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1,'type'=>2))->select();
				if($separate){
					foreach($separate as $v){
						M('mch')->where(array('id'=>$v['pmch']))->save(array(
							'money' => array('exp', 'money+'.$v['money']),
						));
					}
					 M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1,'type'=>2))->save(array('status'=>2));
				}
				
				flog($this -> user['id'],'money',$data['total_fee']/100, 9); // 记录财务日志
			}elseif($table == "prize"){
				M('anime') -> where(array('id'=>$order_info['anid'])) -> save(array(
					'prize' => array('exp', 'prize+'.$order_info['money']),
				));
				
				//添加用户打赏记录
				if(!M('user_prize')->where(array('user_id'=>$order_info['user_id'],'anid'=>$order_info['anid']))->find()){
					M('user_prize')->add(array(
						"user_id"=>$order_info['user_id'],
						"nickname"=>$this->user['nickname'],
						"headimg"=>$this->user['headimg'],
						"anid"=>$order_info['anid'],
						"prize"=>$order_info['money'],
					));
				}else{
					M('user_prize')->where(array('user_id'=>$order_info['user_id'],'anid'=>$order_info['anid']))->save(array(
						'prize' => array('exp', 'prize+'.$order_info['money']),
					));
				}
				
				//查询是否有分成
				$separate = M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1,'type'=>3))->select();
				if($separate){
					foreach($separate as $v){
						M('mch')->where(array('id'=>$v['pmch']))->save(array(
							'money' => array('exp', 'money+'.$v['money']),
						));
					}
					 M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1,'type'=>3))->save(array('status'=>2));
				}
				
				flog($this -> user['id'],'money',$data['total_fee']/100, 10); // 记录财务日志
			}
		}

		
		die('SUCCESS');
	}// index
}