<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
	
	public function _initialize(){
		$this -> _site = M('config')->where(array('name'=>'site'))->getField('value');
		$this -> _site = json_decode($this->_site,1);
		//当前域名
		$serviceUrl = $_SERVER['HTTP_HOST'];
		if($serviceUrl == $this->_site['url']){
			$mp = array(
				"appid"=>$this->_site['appid'],
				"appsecret"=>$this->_site['appsecret'],
				"mch_id"=>$this->_site['mchid'],
				"key"=>$this->_site['mchkey'],
			);
			
		}else{
			$mch = M('mch')->where(array('url'=>$serviceUrl))->find();
			if(!$mch){
				die("没有代理信息！");
			}else{
				$mp = array(
					"appid"=>$mch['appid'],
					"appsecret"=>$mch['appsecret'],
				);
			}
			$this->mch = $mch;
			$this->_site['subscribe'] = $mch['subscribe'];
		}
		$this->_mp = $mp;
		
		$this->dd = new \Common\Util\ddwechat;
		// 判断mp配置
		if(!$this -> _mp){
			$this->dd -> response('管理员没有配置公众号信息');
			exit;
		}	
		$this->dd -> setParam($this -> _mp);
	}
	
    public function index(){

		// 验证URL
		if(isset($_GET['echostr'])){
			die($_GET['echostr']);
		}
		
		$this -> data = $this->dd -> request();	

		//如果是关注
		if($this -> data['msgtype'] == 'event'){
			// 关注
			if($this -> data['event'] == 'subscribe'){
				$user_info = M('user') -> where("openid='".$this -> data['fromusername']."'") -> find();
				$wechat_user = $this->dd -> getuserinfo($this -> data['fromusername']);
				if(!$user_info){
					// 首次关注,将用户信息保存到数据库
					$accesstoken = $this->dd -> getaccesstoken();
					if(!$accesstoken && APP_DEBUG){
						$this->dd -> response('accesstoken获取失败:' . $this->dd -> errmsg);
					}
					if(!$wechat_user && APP_DEBUG){
						$this->dd -> response('获取用户信息失败:'. $this->dd -> errmsg);
					}
					$user_info = array(
							'mch' => $this->mch['id']?$this->mch['id']:0,
							'openid' => $this -> data['fromusername'],
							'subscribe' => 1,
							'sub_time' => NOW_TIME,
							'nickname' => $wechat_user['nickname'],
							'headimg' => $wechat_user['headimgurl'],
							'sex' => $wechat_user['sex'],
							'join_time'=>time(),
							'chaptitle'=>session("chapter.name")?session("chapter.name"):"",
					);
					//file_put_contents("log.txt",  var_export($user_info, true), FILE_APPEND);
					$rs = M('user') -> add($user_info);
					if(!$rs && APP_DEBUG){
						$this->dd -> response('保存用户信息失败');
					}
					
					$user_info['id'] = $rs;
					
					if(!empty($this -> data['eventkey'])){
						
						// 如果是带参数的二维码则锁定上级关系
						if(!empty($this -> data['eventkey'])){
							$param = explode("_",$this -> data['eventkey']);
							$mch = $param[2];
							$code = $param[3];
							if(!empty($param)){
								M('user')->where(array('id'=>$rs))->save(array('mch'=>$mch));
								M('scan')->add(array(
									"code"=>$code,
									"mch"=>$mch,
									"user_id"=>$rs,
									"create_time"=>time(),
								));
							}
						}
						$this->dd -> response('扫码登录成功！');
					}

					//如果设置了关注时回复关键词则调用回复
					if(!empty($this->mch)){
						if(!empty($this -> mch['subscribe'])){
							$this -> reply_by_keyword($this -> mch['subscribe']);
						}
					}else{
						if(!empty($this -> _site['subscribe'])){
							$this -> reply_by_keyword($this -> _site['subscribe']);
						}
					}
					
					
					//发送阅读历史记录
					$this->readHistory($rs);
					
					if(session('chapter')){
						//判断是否有带推广id的链接
						M('chapter')->where(array('id'=>session('chapter.id')))->save(array(
							'pernums' => array('exp', 'pernums+1'),
							'subnums' => array('exp', 'subnums+1'),
						));
					}
				}else{
					M('user') -> where(array('openid' => $this -> data['fromusername'])) -> save(array(
						'subscribe'=>1,
						'nickname' => $wechat_user['nickname'],
						'headimg' => $wechat_user['headimgurl'],
						'sex' => $wechat_user['sex'],
					));
					//如果有代理ID 和 用户没有代理关系
					if($user_info['mch'] == 0 && !empty($this->mch)){
						M('user') -> where(array('openid' => $this -> data['fromusername'])) -> save(array('mch'=>$this->mch['id']));
					}
					if(!empty($this -> data['eventkey'])){
						// 如果是带参数的二维码则是扫码登录
						if(!empty($this -> data['eventkey'])){
							$param = explode("_",$this -> data['eventkey']);
							$mch = $param[2];
							$code = $param[3];
							if(!empty($param)){
								M('scan')->add(array(
									"code"=>$code,
									"mch"=>$mch,
									"user_id"=>$user_info['id'],
									"create_time"=>time(),
								));
							}
						}
						$this->dd -> response('扫码登录成功！');
					}
					//发送阅读历史记录
					$this->readHistory($user_info['id']);
				}
				
			}elseif( $this -> data['event'] == 'unsubscribe'){// 取消关注
				M('user') -> where(array('openid' => $this -> data['fromusername'])) -> save(array('subscribe'=>0,'mch'=>0));
			}elseif( $this -> data['event'] == 'CLICK'){// 点击自定义菜单
				$this -> reply_by_keyword($this -> data['eventkey']);
			}elseif( $this -> data['event'] == "SCAN"){
				$user_info = M('user') -> where("openid='".$this -> data['fromusername']."'") -> find();
				// 如果是带参数的二维码
				if(!empty($this -> data['eventkey'])){
					$param = explode("_",$this -> data['eventkey']);
					$mch = $param[1];
					$code = $param[2];
					if(!empty($param)){
						M('scan')->add(array(
							"code"=>$code,
							"mch"=>$mch,
							"user_id"=>$user_info['id'],
							"create_time"=>time(),
						));
					}
				}
				$this -> dd -> response('扫码登录成功！');
			}else{
				exit('success');
			}
		}elseif($this -> data['msgtype'] == 'text' && !empty($this -> data['content'])){// 如果是发送文字
			$this -> reply_by_keyword($this -> data['content']);
		}else{
			exit('success');
		}
		
		exit('success');
    }
	
	// 根据关键词回复
	private function reply_by_keyword($key){
		$dd = $this -> dd;
		$replys = M('autoreply') -> where(array(
			'status' => 1,
			'mch'=>$this->mch['id']?$this->mch['id']:0,
			'_string' => "find_in_set('{$key}',keyword)"
		)) -> fetchSql(0) -> select();
		
		if(!$replys){
			$replys = M('autoreply') -> where(array(
				'status' => 1,
				'mch'=>0,
				'_string' => "find_in_set('{$key}',keyword)"
			)) -> fetchSql(0) -> select();
		}
		
		if(empty($replys) || count($replys)<1){// 没有关键词对应回复
			$dd -> response('管理员偷懒，没有回复您的消息~！');
		}elseif(count($replys) ==1 && $replys[0]['type'] == 1){ //只有用一条记录,且是文本回复
			$row = $replys[0];
			if(!empty($row['content'])){
				$dd -> response($row['content']);
			}
		}else{// 多条记录或者一条图文记录都是图文回复
			$pids = array();
			foreach($replys as $row){
				if($row['type'] ==2){
					$pids[] = $row['id'];
				}
			}
			if(count($pids) >0){
				// 查询所有文章
				$news = M('news') -> where(array(
					'aid' => array('in', $pids)
				)) -> limit(10) -> order('id desc') -> select();
				foreach($news as $v){
					$url = $v['url'];
					if($v['mch'] == 0 && $this->mch){
						$reg = '/(http):\/\/([^\/]+)/i';
						$murl = $this->mch['url'];
						$url = preg_replace($reg, 'http://'.$murl, $url);
					}
					$msgs[] = array(
						'title' => $v['title'],
						'description' => $v['desc'],
						'picurl' => complete_url($v['pic']),
						'url' => $v['url'],
					);
				}
				$dd -> response(array('articles' => $msgs), 'news');
			}
		}
	}
	
	
	//发送阅读历史记录
	private function readHistory($userid){
		$read = M('readhistory')->where(array('user_id'=>$userid,'ismax'=>2))->order('create_time desc')->limit(6)->select();
		$html = "尊敬的用户，您已关注成功！";
		if(!$read || !empty($read)){
			$html.="\n\n";
			$url = complete_url(U('Index/readAnime',array('anid'=>$read[0]['anid'],'chaps'=>$read[0]['chaps'])));
			$html.='<a href="'.$url.'">【点击继续阅读】</a>';
			$html.="\n\n";
			if(count($read)>1){
				$html.="历史阅读记录：";
				$html.="\n\n";
				for($i=1;$i<count($read);$i++){
					$url = complete_url(U('Index/readAnime',array('anid'=>$read[$i]['anid'],'chaps'=>$read[$i]['chaps'])));
					$html.='<a href="'.$url.'">>'.$read[$i]['title'].'</a>';
					$html.="\n\n";
				}
				$html.="为方便下次阅读，请置顶公众号！";
			}
			$this -> dd -> response($html);
		}
	}
}
