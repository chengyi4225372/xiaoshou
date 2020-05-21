<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
		
		header("Content-type: text/html; charset=utf-8");
	//var_dump($_SERVER);exit;
		/*
		//PC端
		if(!IS_MOBILE && !is_weixin() && ACTION_NAME == "index"){
			redirect(U("Homee/".CONTROLLER_NAME."/".ACTION_NAME,$_GET));
			exit;
		}
		*/
		//当前域名
		$serviceUrl = $_SERVER['HTTP_HOST'];
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

			$mp = array(
				"appid"=>$this->_site['appid'],
				"appsecret"=>$this->_site['appsecret'],
				"mch_id"=>$this->_site['mchid'],
				"key"=>$this->_site['mchkey'],
			);
			$this->_mp = $mp;
			$this->assign("_mp",$mp);
			if(!session('title') ||  session('title') != $this->_site['name']){
				session('title',$this->_site['name']);
				session('qrcode',$this->_site['qrcode']);
			}
		}else{
            /*
			$mch = M('mch')->where(array('url'=>$serviceUrl))->find();

			if(!$mch){
				die("没有代理信息2！");
			}else{
				$mp = array(
					"appid"=>$mch['appid'],
					"appsecret"=>$mch['appsecret'],
				);
				$this->_mp = $mp;
				$this->assign("_mp",$mp);
				
				session('mch',$mch);
			}
            */
			if(!session('title') ||  session('title') != $mch['title']){
				session('title',$mch['title']);
				session('qrcode',$mch['qrcode']);
			}
		}

		
		if($_GET['plat'] && $_GET['plat'] == "app"){
			session('plat','app');
		}
		
		if(session("?plat")){
			$this->assign('plat',1);
		}
		//若带有订阅号推广参数，且不管是什么的订阅号都取总站的设置参数
		if($_GET['mch']){
			$mchid = decode($_GET['mch']);
			$mch = M('mch')->find(intval($mchid));
			if($mch && $mch['status'] == 1){
				session('title',$mch['title']);
				session('qrcode',$mch['qrcode']);
				//确定有推广员
				session('mch',$mch);
				//如果推广员没有上级，则是主站推广员
				if($mch['parent1']>0){
					$parent = M('mch')->find(intval($mch['parent1']));
					$this->_mp = array(
						"appid"=>$parent['appid'],
						"appsecret"=>$parent['appsecret'],
					);
				}else{
					$this->_mp = array(
						"appid"=>$this->_site['appid'],
						"appsecret"=>$this->_site['appsecret'],
						"mch_id"=>$this->_site['mchid'],
						"key"=>$this->_site['mchkey'],
					);
				}
				$this->assign("_mp",$mp);
			}
			if($mch['status'] == -2){
				die('代理还在审核中，不能进行访问！');
			}
		}

		$this->mch = session('mch');
		$this->assign('mch',$this->mch);
		
		if($this->mch && $this->mch['status'] !=1){
			die('代理已被禁用！');
		}
		
		//网站名称
		$this->assign('title',session('title'));
		//公众号二维码地址
		$this->assign('qrcode',session('qrcode'));

		
		//判断是否有带推广id的链接
		if($_GET['chapter']){
			$chapterid = decode($_GET['chapter']);
			$chapter = M('chapter')->find(intval($chapterid));
			if($chapter && !empty($chapter) && $chapter['status'] == 1){
				session('chapter',$chapter);
			}
		}
		
		$this->chapter = session('chapter');
		$this->assign('chapter',$this->chapter);

		if(PHP_SAPI !='cli')$this -> _get_user();
		
		
		//漫画小说是否带有分享user
		if($_GET['shareUser']){
			$shareId = decode($_GET['shareUser']);
			$shareUser = M('user')->find(intval($shareId));
			
			if($shareId != $this->user['id']){
				$share = M('share')->where(array('date'=>date('Ymd'),'user_id'=>$shareId,'self_id'=>$this->user['id'],"type"=>1))->find();
				if($shareUser && !$share){
					M('user')->where(array('id'=>$shareId))->setInc('money',$this->_site['sharemoney']);
					flog($shareId, 'money', $this->_site['sharemoney'], 5);
					M('share')->add(array(
						"user_id"=>$shareId,
						"self_id"=>$this->user['id'],
						"date"=>date('Ymd'),
						"nickname"=>$this->user['nickname'],
						"create_time"=>time(),
						"money"=>$this->_site['sharemoney'],
						"type"=>1,
					));
				}
				
			}			
		}
		
		//名家是否带有分享user
		if($_GET['sellerUser'] && $_GET['sellerid']){
			$shareId = decode($_GET['sellerUser']);
			$shareUser = M('user')->find(intval($shareId));
			
			$seller = M('seller')->find(intval($_GET['sellerid']));
			
			if($shareId != $this->user['id']){
				$share = M('share')->where(array('date'=>date('Ymd'),'user_id'=>$shareId,'self_id'=>$this->user['id'],"type"=>2))->find();
				if($shareUser && !$share){
					M('user')->where(array('id'=>$shareId))->setInc('money',$seller['smoney']);
					flog($shareId, 'money', $seller['smoney'], 8);
					M('share')->add(array(
						"user_id"=>$shareId,
						"self_id"=>$this->user['id'],
						"date"=>date('Ymd'),
						"nickname"=>$this->user['nickname'],
						"create_time"=>time(),
						"money"=>$seller['smoney'],
						"type"=>2,
					));
				}
				
			}			
		}
		
		
		$fr = get_current_url();
		
		/**返回地址带有amp;进行跳转**/
		if(strpos($fr, 'amp;') !== false){
			$url = str_replace('amp;','',$fr);			
			redirect($url);
		}
        //当前域名
        $serviceUrl = $_SERVER['SERVER_NAME'];
		$nav = M('nav')->order('create_time desc')->select();
        $this->assign('nav',$nav);
		
        $middle = M('middle')->order('sort asc')->select();
        $this->assign('middle',$middle);
      
        $this->assign('serviceUrl',$serviceUrl);
		
    }
	
	
	private function _get_user(){
       // $_GET['debug_user_id'] ='800805';
		// 开发调试时快捷模拟登陆任何用户
		if(APP_DEBUG && $_GET['debug_user_id']){
			session('user', M('user') -> find($_GET['debug_user_id']));
		}
		
		if(session('?user')){
			$this -> user = M('user') -> find(session('user.id'));
			if($this->user['mch'] == 0 && $this->mch){
				M('user')->where(array('id'=>$this->user['id']))->save(array('mch'=>$this->mch['id']));
			}
		}
		
		// 如果是微信则尝试自动登录
		if(IS_WECHAT && !session('?user') && !session('?wechat_info')){
			$this -> _auto_login();
		}
		
		// 判断此控制器是否免登录
		$no_login = array(
			'Index/index',
			'Index/info',
			'Index/bookType',
			'Index/moreList',
			'Index/novel',
			'Index/video',
			'Index/story',
			'Index/rank',
			'Index/readAnime',
			'Ajax/loadChaps',
			'Ajax/loadMoreChaps',
			'Ajax/nextChaps',//读取章节
			'Ajax/getBookType',
			'Ajax/getMoreList',
			'Ajax/test',
			'Index/test',
		);
		
		
			
	
		// 不是免登录访问则要求登陆（废弃扫码登录）
		/*
		if(!$this -> user && !in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $no_login)){
			if(IS_POST){
				$this->error('请先登录！',U('Public/login?fr='.base64_encode(get_current_url())));
			}else{
				redirect(U('Public/login?fr='.base64_encode(get_current_url())));
			}
		}
		*/
		
		//更改逻辑，若非微信环境中，没有用户则自动生成用户。
		$psw = getRandCode();
		if(!IS_WECHAT && !$this -> user && !in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $no_login)){
			$user_info = array(
				"mch"=>$this->mch['id']?$this->mch['id']:0,
				"username"=>getRandCode(),
				"psw"=>md5($psw),
				"tpsw"=>$psw,
				"headimg"=>'./Public/home/img/user.png',
				"sex"=>0,
				"openid"=>"",
				"join_time"=>time(),
				"chaptitle"=>$this->chapter['name'],
				'unionid' => $rt['unionid'],
			);
			$user_info['id'] = M('user')->add($user_info);
			M('user')->where(array('id'=>$user_info['id']))->save(array('nickname'=>"用户".$user_info['id']));
			$user_info['nickname'] = "用户".$user_info['id'];
			session('user',$user_info);
			$this->user = $user_info;
		}
		
		if($this -> user){
			$GLOBALS['USER'] = $this -> user;
			$this->assign('user',$this->user);
		}
		
		//判断用户vip是否到期
		if($this->user['viptime']>0){
			if(time()>=$this->user['viptime']){
				M('user')->where(array('id'=>$this->user['id']))->save(array('viptime'=>0));
			}
		}
		
		//获取模板
		$this -> _tpl();
	}
	
	
	
	// 尝试自动登录
	private function _auto_login(){
		if(!isset($_GET['code'])){
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this -> _mp['appid']."&redirect_uri=".urlencode(get_current_url())."&response_type=code&scope=snsapi_base&state=lswigcn#wechat_redirect";
			redirect($url);
			exit;
		}elseif($_GET['state'] == 'lswigcn'){
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this -> _mp['appid']."&secret=".$this -> _mp['appsecret']."&code=".$_GET['code']."&grant_type=authorization_code";
			
			$http = new \Common\Util\ddhttp;
			
			$rs = $http -> get($url);
			if(!$rs)$this -> error('获取OPENID失败');
			$rt = json_decode($rs, 1);
			if($rt['errcode'])$this -> error('授权失败:'.$rt['errmsg']);

			// 判断是否已注册
			$user_info = M('user') -> where(array('openid' => $rt['openid'])) -> find();
			if(!$user_info){
				$psw = getRandCode();
				$user_info = array(
					"mch"=>$this->mch['id']?$this->mch['id']:0,
					"headimg"=>'./Public/home/img/user.png',
					"sex"=>0,
					"username"=>getRandCode(),
					"psw"=>md5($psw),
					"tpsw"=>$psw,
					"openid"=>$rt['openid'],
					"join_time"=>time(),
					"chaptitle"=>$this->chapter['name'],
					'unionid' => $rt['unionid'],
				);
				$id = M('user')->add($user_info);
				M('user')->where(array('id'=>$id))->save(array('nickname'=>'用户'.$id));
				$user_info = M('user')->find(intval($id));
			}else{
				//针对取消关注的用户重新锁定所属代理
				if($user_info['mch'] == 0 && $this->mch){
					M('user')->where(array('id'=>$user_info['id']))->save(array('mch'=>$this->mch['id']));
				}
			}
			
			//判断是否有带推广id的链接
			if($this->chapter){
				M('chapter')->where(array('id'=>$this->chapter['id']))->setInc("pernums",1);
			}
			
			session('user', $user_info);
			// 获取到了之后需要跳转一次，以去掉地址中的CODE和STATE
			unset($_GET['code']);
			unset($_GET['state']);
			redirect(U(null, $_GET));
			exit;
		}
	}
	
	
	//查询模板
	public function _tpl(){
		$mch = $this->mch['id']?$this->mch['id']:0;
		$tpl = M('tpl')->where(array('mch'=>$mch))->getField('tpl');
		if(!$tpl){
			$tpl = M('tpl')->where(array('mch'=>0))->getField('tpl');
			$tpl = $tpl?$tpl:1;
		}
		$temp = "Index/temp".$tpl."/".ACTION_NAME;
		$this -> tpl = $temp; 
	}
	
}