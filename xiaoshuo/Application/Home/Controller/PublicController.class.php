<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
	public function _initialize(){
		// 从数据读取配置参数
		$this -> _site = M('config')->where(array('name'=>'site'))->getField('value');
		$this -> _site = json_decode($this->_site,1);
		
		//当前域名
		$serviceUrl = $_SERVER['SERVER_NAME'];
        //$serviceUrl="a.ruiqi88.com";
		if($serviceUrl == $this->_site['url']){
			$mp = array(
				"appid"=>$this->_site['appid'],
				"appsecret"=>$this->_site['appsecret'],
				"mch_id"=>$this->_site['mchid'],
				"key"=>$this->_site['mchkey'],
			);
			$this->mch = array(
				"id"=>0,
			);
			if(!session('title') ||  session('title') != $this->_site['name']){
				session('title',$this->_site['name']);
			}
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
			if(!session('title') ||  session('title') != $mch['title']){
				session('title',$mch['title']);
			}
		}
		$this->_mp = $mp;
		
		//网站名称
		$this->assign('title',session('title'));
	}
	
	
	// 登录(废弃)
	/*
    public function login(){
		//生成扫码的二维码		
		$code = md5(uniqid());
		$qrcode = $this->createQrcode($code);	
		$this->assign('qrcode',$qrcode);
		$this->assign('code',$code);
		$this->display();
    }
	*/
	public function login(){
		if(IS_POST){
			$post = I('post.');
			$post['psw'] = md5($post['psw']);
			$user = M('user')->where(array('username'=>$post['username'],'psw'=>$post['psw']))->find();
			if(!$user){
				$this->error('账号或密码错误！');
			}
			session('user',$user);
			$this->success('登录成功！',U('Index/my'));
		}
		$this->display();
	}
	
	private function createQrcode($code){
		$dd = new \Common\Util\ddwechat($this -> _mp);
		
		$path = './Public/scan/';
		
		$qrcode = './Public/scan/qrcode_'.$this->mch['id'].'_'.$code.'.jpg';
		if(!is_file($path_info['qrcode'])){
			$accesstoken = $dd -> getaccesstoken();
			$rs = $dd -> createqrcode('user_'.$this->mch['id'].'_'.$code,null,$accesstoken);
			if(!$rs){
				if(APP_DEBUG){
					$this -> error($dd -> errmsg);
				}else{
					$this -> error('推广二维码生成失败，请稍后重试！');
				}
			}
			$qrcode_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$rs['ticket'];
			$qrcode_img = $dd -> exechttp($qrcode_url, 'get', null , true); //file_get_contents($qrcode_url);
			if(!$qrcode_img){
				$this -> error('获取二维码失败');
			}
			$save = file_put_contents($qrcode,$qrcode_img);
			if(!$save){
				$this -> error('二维码保存失败！');
			}
		}
		return $qrcode;
	}
	
	
	//判断是否登录
	public function checkLogin(){
		if(IS_POST){
			$code = I('post.code');
			$fr = I('post.fr');
			$scan = M('scan')->where(array('code'=>$code))->find();
			if($scan && $scan['user_id']){
				$user = M('user')->find(intval($scan['user_id']));
				M('scan')->where(array('code'=>$code))->delete(); //删除数据库数据
				$file =  './Public/scan/qrcode_'.$scan['mch'].'_'.$code.'.jpg'; //删除临时二维码文件
				unlink($file);
				session('user',$user);
				$this->success('扫码登录成功！',base64_decode($fr));
			}else{
				$this->error('未登录！',M()->getLastSql());
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	//退出登录
	public function logout(){
		session('user',null);
		redirect(U('Public/login'));
	}
}?>