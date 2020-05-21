<?php
namespace Pay\Controller;
use Think\Controller;
class PaysnotifyController extends Controller {
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
	
	//处理支付
    public function index(){
		$paysapi_id = $_POST["paysapi_id"];
		$orderid = $_POST["orderid"];
		$price = $_POST["price"];
		$realprice = $_POST["realprice"];
		$orderuid = $_POST["orderuid"];
		$key = $_POST["key"];
		
		//校验传入的参数是否格式正确
		$token = $this->_site['paystoken'];
		
		$temps = md5($orderid . $orderuid . $paysapi_id . $price . $realprice . $token);
		if ($temps != $key){
			die("key值不匹配");
		}else{
			//key值匹配，处理业务逻辑
			$order_info = M('charge')->where(array('sn'=>$orderid))->find();
			// 获取用户信息，异步通知不执行网页认证授权，需要获取用户信息
			$this -> user = M('user') -> find(intval($order_info['user_id']));
			if(!$this -> user){
				die('Fail');
			}
			if($order_info['status'] !=1){
				die('FAIL');
			}		
			$money = $order_info['money'];
			
			// 已支付全部费用
			if($realprice >= $money){
				
				$save['status'] = 2;
				$save['pay_time'] = NOW_TIME;
				
				M($orderuid) -> where(array('sn'=>$orderid)) -> save($save);
				//书币充值
				if($orderuid == "charge"){
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
						flog($this -> user['id'],'money',$money, 1); // 记录财务日志
					}
					

					//判断是否有推广链接
					if($order_info['chapter']>0){
						M('chapter')->where(array('id'=>$order_info['chapter']))->save(array(
							'charge' => array('exp', 'charge+'.$order_info['money']),
						));
					}			
						
					//查询是否有分成
					$separate = M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1))->select();
					if($separate){
						foreach($separate as $v){
							M('mch')->where(array('id'=>$v['pmch']))->save(array(
								'money' => array('exp', 'money+'.$v['money']),
							));
						}
						 M('separate')->where(array('order_id'=>$order_info['id'],'status'=>1))->save(array('status'=>2));
					}
				}elseif($orderuid == "activity_buy"){ //活动充值
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
					
				}elseif($orderuid == "prize"){
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
					
					flog($this -> user['id'],'money',$order_info['money'], 10); // 记录财务日志
				}
				
			}
		}
    }
	
	
	
}?>