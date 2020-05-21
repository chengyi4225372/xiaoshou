<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends CommonController {
	
	public function authUser(){
		$code = I('post.code');
		if(!$code){
			$this->_appErrMsg('请求参数丢失！');
		}
		
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->_site['open_appid']."&secret=".$this->_site['open_appsecret']."&code=".$code."&grant_type=authorization_code";
		$http = new \Common\Util\ddhttp;
		$rs = $http -> get($url);
		
		if(!$rs)$this -> _appErrMsg('获取OPENID失败');
		$rt = json_decode($rs, 1);

		if($rt['errcode'])$this -> _appErrMsg('授权失败:'.$rt['errmsg']);
		// 拉取用户信息
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$rt['access_token']."&openid=".$rt['openid']."&lang=zh_CN ";
		$wechat_info = $http -> get($url);
		if(!$wechat_info)$this -> _appErrMsg('获取用户资料失败:CURL '.$http -> errmsg);
		$wechat_info = json_decode($wechat_info, 1);

		$user = M('user')->where(array('unionid'=>$wechat_info['unionid']))->find();
		
		if(!$user){
			$user_info = array(
				'nickname' => $wechat_info['nickname'],
				'openid' => $wechat_info['openid'],
				'unionid' => $wechat_info['unionid'],
				'sex' => $wechat_info['sex'],
				'headimg' => $wechat_info['headimgurl'],
				'sub_time'=>time(),
				'parent1' => intval($_GET['parent']),
				'jointype' => "APP微信登录",
			);
			$user_info['id'] = M('user') -> add($user_info);
			$user = M('user')->find(intval($user_info['id']));
		}
		if($user['mch'] != 0 ){
			$mch = M('mch')->find(intval($user['mch']));
		}
		if($mch){
			$url = "http://".$mch['url'].'/index.php?debug_user_id='.$user['id']."&plat=app";
		}else{
			$url = "http://".$this->_site['url'].'/index.php?debug_user_id='.$user['id']."&plat=app";
		}
		
		//获取底部按钮
		$nav = array(
			array(
				"sort"=>1,
				"name"=>"推荐",
				"url"=> "http://".$this->_site['url'].'/index.php?a=novel&debug_user_id='.$user['id']."&plat=app",
			),
			array(
				"sort"=>2,
				"name"=>"找书",
				"url"=> "http://".$this->_site['url'].'/index.php?a=bookType&btype=2&debug_user_id='.$user['id']."&plat=app",
			),
			array(
				"sort"=>3,
				"name"=>"书架",
				"url"=> "http://".$this->_site['url'].'/index.php?a=readHistory&debug_user_id='.$user['id']."&plat=app",
			),
			array(
				"sort"=>4,
				"name"=>"我的",
				"url"=> "http://".$this->_site['url'].'/index.php?a=my&debug_user_id='.$user['id']."&plat=app",
			),
		);
		
	

		$this->_appSuccMsg(array('list'=>$user,'url'=>$url,'nav'=>$nav));
	}
	
	
}