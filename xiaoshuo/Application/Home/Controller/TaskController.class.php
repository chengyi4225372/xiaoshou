<?php
namespace Home\Controller;
use Think\Controller;
class TaskController extends Controller {	
	//计划任务发送客服消息
	public function index(){

		//查询大于发送时间并且未发送完成的客服记录
		$list = M('custom')->where(array('stime'=>array('elt',time()),'status'=>1))->select();
		if($list){
			foreach($list as $k=>$v){
				//查询用户条件
				if($v['sex'] && $v['sex']>0){
					if($sex == 3){
						$where_user['sex'] = 0;
					}else{
						$where_user['sex'] = $v['sex'];
					}
				}
				if($v['charge'] && $v['charge']>0){
					if($v['charge'] == 1){
						$where_user['charge_total'] = array('gt',0);
					}else{
						$where_user['charge'] = 0;
					}
				}
				if($v['money'] && $v['money']>0){
					if($money == 1){
						$where_user['money'] = array('lt',500);
					}elseif($money == 2){
						$where_user['money'] = array('lt',2000);
					}else{
						$where_user['money'] = array('lt',5000);
					}
				}
				if($v['join_time'] && $v['join_time']>0){
					if($join_time == 1){
						$where_user['join_time'] = array('egt',strtotime(date('Y-m-d')));
					}elseif($join_time == 2){
						$where_user['join_time'] = array('egt',strtotime(date("Y-m-d", strtotime("-1 week"))));
					}elseif($join_time == 3){
						$where_user['join_time'] = array('egt',strtotime("-15 day"));
					}elseif($join_time == 4){
						$where_user['join_time'] = array('egt',strtotime("-1 month"));
					}elseif($join_time == 5){
						$where_user['join_time'] = array('egt',strtotime("-3 month"));
					}
				}
				$where_user['mch'] = $v['mch'];
				
				
				//发送的图文内容
				$info = $v['info'];
				$msgs[0] = array(
					'title' => $v['title'],
					'description' => $v['remark'],
					'picurl' => $v['pic'],
					'url' => $v['url'],
				);
				$info = json_decode($info,1);
				if(is_array($info)){
					foreach($info as $key=>$val){
						$msgs[$key+1] = array(
							'title' => $val['title'],
							'description' => $post['remark'],
							'picurl' => $val['picurl'],
							'url' => $val['url'],
						);
					}
				}
				
				if($v['mch'] == 0){ //主公众号
					$site = M('config')->where(array('name'=>'site'))->getField('value');
					$site = json_decode($site,1);
					$mp = array(
						"appid"=>$site['appid'],
						"appsecret"=>$site['appsecret'],
					);
				}else{ //代理公众号
					$mch = M('mch')->find(intval($v['mch']));
					$mp = array(
						"appid"=>$mch['appid'],
						"appsecret"=>$mch['appsecret'],
					);
				}
				//查询是否有发送记录
				$send = M('custom_send')->where(array('customid'=>$v['id'],'mch'=>$v['mch']))->order('user_id desc')->find();
				if($send){ //若有发送记录
					//查询大于id的50条数据
					$where_user['id'] = array('gt',$send['user_id']);
					$user = M('user')->where($where_user)->order('id asc')->limit(50)->select();
					if($user){
						foreach($user as $val){
							send_msg($mp,$val['openid'],$msgs,'news');
							//增加发送记录
							M('custom_send')->add(array(
								"user_id"=>$val['id'],
								"customid"=>$v['id'],
								"mch"=>$v['mch'],
								"create_time"=>time(),
							));
						}
					}else{ // 没有用户代表发送完成
						M('custom')->where(array('id'=>$v['id']))->save(array('status'=>2));
					}
					
				}else{ //若没有发送记录，计划任务每分钟按用户ID 升序发送50个用户					
					$user = M('user')->where($where_user)->order('id asc')->limit(50)->select();
					if($user){
						foreach($user as $val){
							send_msg($mp,$val['openid'],$msgs,'news');
							//增加发送记录
							M('custom_send')->add(array(
								"user_id"=>$val['id'],
								"customid"=>$v['id'],
								"mch"=>$v['mch'],
								"create_time"=>time(),
							));
						}
					}
				}
			}
		}
	}
	
	
}?>