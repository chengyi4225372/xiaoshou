<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController {
   
	public function _empty(){
		$this -> _save();
		$this -> display();
	}
	
	
	
	// 配置管理账号
	public function user(){
		if(IS_POST){
			if(empty($_POST['name'])){
				$this -> error('请正确填写登录名');
				
			}else if($_POST['pass'] != $_POST['tpass'] || empty($_POST['pass'])){
				$this -> error('请正确填写密码!');
			}
			
			$_POST['pass'] = xmd5($_POST['pass']);
			unset($_POST['tpass']);
			
			// 调用保存方法
			$this -> _save();
		}
		
		$this -> display();
	}
	
	//广告设置
	public function ads(){
		if(IS_POST){
			$config = array();
			foreach($_POST['pic'] as $k=>$v){
				$config[$k+1] = array('pic'=>$v,'nums'=>$_POST['nums'][$k],'url'=>$_POST['url'][$k]);
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//漫画发布区域
	public function mhArea(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//漫画分类
	public function mhStore(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	
	//漫画轮播
	public function mhBanner(){
		if(IS_POST){
			$pic = I('post.pic');
			$url = I('post.url');
			$config = array();
			foreach($pic as $k=>$v){
				$config[$k] = array('pic'=>$v,'url'=>$url[$k]);
			}
			unset($_POST);
			$_POST = $config;
			$this->_save();
		}
		$this->display();
	}
	
	
	//小说发布区域
	public function xsArea(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//小说分类
	public function xsStore(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//小说轮播
	public function xsBanner(){
		if(IS_POST){
			$pic = I('post.pic');
			$url = I('post.url');
			$config = array();
			foreach($pic as $k=>$v){
				$config[$k] = array('pic'=>$v,'url'=>$url[$k]);
			}
			unset($_POST);
			$_POST = $config;
			$this->_save();
		}
		$this->display();
	}
	
	
	//听书发布区域
	public function stArea(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//听书分类
	public function stStore(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//听书轮播
	public function stBanner(){
		if(IS_POST){
			$pic = I('post.pic');
			$url = I('post.url');
			$config = array();
			foreach($pic as $k=>$v){
				$config[$k] = array('pic'=>$v,'url'=>$url[$k]);
			}
			unset($_POST);
			$_POST = $config;
			$this->_save();
		}
		$this->display();
	}
	
	//视频轮播
	public function vdBanner(){
		if(IS_POST){
			$pic = I('post.pic');
			$url = I('post.url');
			$config = array();
			
			foreach($pic as $k=>$v){
				$config[$k] = array('pic'=>$pic[$k],'url'=>$url[$k]);
			}
			unset($_POST);
			$_POST = $config;
			$this->_save();
		}
		
		$this->display();
	}
	
	//视频分类
	public function vdStore(){
		if(IS_POST){
			$config = array();
			foreach($_POST['pic'] as $k=>$v){
				$config[$k+1] = array('pic'=>$_POST['pic'][$k],'name'=>$_POST['name'][$k]);
			}
			unset($_POST);
			$_POST = $config;

			$this->_save();
		}
		$this->display();
	}
	
	
	//视频发布区域
	public function vdArea(){
		if(IS_POST){
			$config = array();
			foreach($_POST['list'] as $k=>$v){
				$config[$k+1] = $v;
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	
	//充值设定
	public function charge(){
		if(IS_POST){
			$post = I('post.');
			$config = array();
			foreach($post['money'] as $k=>$v){
				$config[$k+1] = array('money'=>$v,'smoney'=>$post['smoney'][$k],'lv'=>$post['lv'][$k],'ishot'=>$post['ishot'][$k],'isyear'=>$post['isyear'][$k],'ishalf'=>$post['ishalf'][$k],'isover'=>$post['isover'][$k],'isopen'=>$post['isopen'][$k],'ischoose'=>$post['ischoose'][$k]);
			}
			unset($_POST);
			$_POST = $config;
			$this->_save();
		}
		//dump($this->_charge);
		$this->display();
	}
	
	
	//打赏金额设置
	public function prize(){
		if(IS_POST){
			$config = array();
			foreach($_POST['pic'] as $k=>$v){
				$config[$k+1] = array("pic"=>$_POST['pic'][$k],"name"=>$_POST['name'][$k],"money"=>$_POST['money'][$k]);
			}
			unset($_POST);
			$_POST = $config;
		}
		$this -> _save();
		$this -> display();
	}
	
	//模板选择
	public function tpl(){
		if(IS_POST){
			$tpl = I('post.tpl');
			$info = M('tpl')->where(array('mch'=>0))->getField('tpl');
			if(!$info){
				M('tpl')->add(array(
					"mch"=>0,
					"tpl"=>$tpl,
				));
			}else{
				M('tpl')->where(array('mch'=>0))->save(array('tpl'=>$tpl));
			}
			$this->success('设置成功！');
			exit;
		}
		$tpl = M('tpl')->where(array('mch'=>0))->getField('tpl');
		if(!$tpl){
			$tpl = 1;
		}
		$this->assign('tpl',$tpl);
		$this->display();
	}
	
	
	private function _save($exit = true){
		// 通用配置保存操作
		if(IS_POST){
			// 有此配置则更新,没有则新增
			if(array_key_exists(ACTION_NAME, $this -> _CFG)){
				M('config') -> where(array('name' => ACTION_NAME)) -> save(array(
					'value' => json_encode($_POST)
				));
			}else{
				M('config') -> add(array(
					'name' => ACTION_NAME,
					'value' => json_encode($_POST)
				));
			}
			if($exit){
				$this -> success('操作成功！');
				exit;
			}
		}
	}

	//首页底部导航
    public function navindex(){
       // echo $_SERVER["SERVER_NAME"];
        if(IS_POST){
            $_GET  = array_merge($_GET, $_POST);
            $_GET['p'] = 1; //如果是post的话回到第一页
        }
        if($_GET['title']){
            $where['title'] = array('like','%'.$_GET['title'].'%');
        }
        $this -> _list('nav',$where,'create_time desc');
    }

    public function navedit(){
        if(!isset($_GET['id'])){
            $_POST['create_time'] = NOW_TIME;
        }
        $this -> _edit('nav', U('navindex'));
    }

    public function logo(){
        if(IS_POST){
            if(empty($_POST['img'])){
                $this -> error('请上传图片');

            }

            // 调用保存方法
            $this -> _save();
        }
        $this -> display();
    }
	
	public function middleindex(){
        // echo $_SERVER["SERVER_NAME"];
        if(IS_POST){
            $_GET  = array_merge($_GET, $_POST);
            $_GET['p'] = 1; //如果是post的话回到第一页
        }
        if($_GET['title']){
            $where['title'] = array('like','%'.$_GET['title'].'%');
        }
        $this -> _list('middle',$where,'sort asc');
    }

    public function middleedit(){
        if(!isset($_GET['id'])){
            $_POST['create_time'] = NOW_TIME;
        }
        $this -> _edit('middle', U('middleindex'));
    }


}