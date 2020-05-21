<?php
namespace Home\Controller;
use Think\Controller;
class PsendController extends Controller {	
	public function _initialize(){
		$this -> _site = M('config')->where(array('name'=>'site'))->getField('value');
		$this -> _site = json_decode($this->_site,1);
	}

	//计划任务发送推送
	public function index(){
		header("Content-type: text/html; charset=utf-8"); 
		//先找出所有代理
		$mch = M('mch')->where(array('status'=>1))->select();
		//推送消息
		$promo = C('PROMOTION');
		foreach($mch as $k=>$v){
			$mp = array(
				"appid"=>$v['appid'],
				"appsecret"=>$v['appsecret'],
			);
			foreach($promo as $key=>$val){
				//如果没找到被禁用信息，则发送
				if(!M('promotion')->where(array('mch'=>$v['id'],'promotionid'=>$key))->find()){
					
					//首冲
					if($key == 1){ 
						$msgs[0] = array(
							'title' => "新人充值特惠活动",
							'description' => "充值9.9元即送2000阅读币",
							'picurl' => "http://".$v['url']."/Public/images/xcharge.jpg",
							'url' => "http://".$v['url']."/index.php?m=&a=charge",
						);
					
						//查询24小时新关注未充值用户
						$xtime = time() - 24*3600; //24小时之前
						$where = array(
							"mch"=>$v['id'],
							'charge_total'=>0,
							'subscribe'=>1,
							'join_time'=>array('elt',$xtime),
						);
						
						//查询已发送的最大的用户ID
						$max_user_id = M('promotion_first')->where(array('promotionid'=>$key,'mch'=>$v['id']))->max('user_id');
						if($max_user_id){
							$where['id'] = array('gt',$max_user_id);
						}	
						$users = M('user')->where($where)->order('id asc')->select();
						
						if($users){
							foreach($users as $vv){
								//发送首冲消息
								$send = M('promotion_first')->where(array('promotionid'=>$key,'mch'=>$v['id'],'user_id'=>$vv['id']))->find();
								if(!$send){
									M('promotion_first')->add(array(
										"promotionid"=>$key,
										"user_id"=>$vv['id'],
										"mch"=>$v['id'],
									));
									send_msg($mp,$vv['openid'],$msgs,'news');
								}
							}
						}
					}
					
					//未支付提醒
					if($key == 2){
						//查询半小时未支付订单
						$xtime = time() - 1800; //半小时之前
						$where = array(
							'mch'=>$v['id'],
							'create_time'=>array('elt',$xtime),
							'status'=>1,
						);
						//查询已发送充值的最大的ID
						$max_chargeid = M('promotion_second')->where(array('promotionid'=>$key,'mch'=>$v['id']))->max('chargeid');
						if($max_chargeid){
							$where['id'] = array('gt',$max_chargeid);
						}
						$charges = M('charge')->where($where)->order('id asc')->select();
						
						if($charges){
							foreach($charges as $vv){
								$user = M('user')->where(array('id'=>$vv['user_id']))->find();
								//发送
								$send = M('promotion_second')->where(array('promotionid'=>$key,'mch'=>$v['id'],'chargeid'=>$vv['id']))->find();
								if(!$send){
									$html = "书币订单未支付提醒；";
									$html.= "\n";
									$html.="亲，您的充值书币订单还未完成，现在充值365元即可成为年费会员，赶快行动吧！";
									$html.="\n\n";
									$url = "http://".$v['url']."/index.php?a=charge";
									$a = '<a href="'.$url.'">点击充值></a>';
									$html.=$a;
									
									M('promotion_second')->add(array(
										"promotionid"=>$key,
										"chargeid"=>$vv['id'],
										"mch"=>$v['id'],
									));
									
									send_msg($mp,$user['openid'],$html);
								}
							}
						}
					}
					
					//继续阅读提醒
					if($key == 3){
						//查询两小时未阅读用户
						$xtime = time() - 7200; //两小时之前
						$where = array(
							'mch'=>$v['id'],
							'create_time'=>array('elt',$xtime),
							'status'=>1,
							'ismax'=>2,
						);
						//查询已发送充值的最大的ID
						$max_rsid = M('promotion_three')->where(array('promotionid'=>$key,'mch'=>$v['id']))->max('rsid');
						if($max_rsid){
							$where['id'] = array('gt',$max_rsid);
						}
						$reads = M('readhistory')->where($where)->order('id asc')->select();
						if($reads){
							foreach($reads as $vv){
								$user = M('user')  ->where(array('id'=>$vv['user_id']))->find();
								$anime = M('anime')->where(array('id'=>$vv['anid']))->find();
								//发送首冲消息
								$send = M('promotion_three')->where(array('promotionid'=>$key,'mch'=>$v['id'],'user_id'=>$user['id']))->find();
								if(!$send){
									$msgs[0] = array(
										'title' => $anime['title'],
										'description' => $anime['remark'],
										'picurl' => $anime['coverpic'],
										'url' => "http://".$v['url']."/index.php?m=&a=readAnime&anid=".$vv['anid']."&chaps=".$vv['chaps'],
									);
									M('promotion_three')->add(array(
										"promotionid"=>$key,
										"rsid"=>$vv['id'],
										"user_id"=>$user['id'],
										"mch"=>$v['id'],
									));
									send_msg($mp,$user['openid'],$msgs,'news');
								}
							}
						}
					}
					
				}
			}
		}
		
	}

}?>