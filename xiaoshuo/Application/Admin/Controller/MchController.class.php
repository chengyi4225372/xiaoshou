<?php
namespace Admin\Controller;
use Think\Controller;
class MchController extends CommonController {
   
	public function index(){
		$where['type'] = 1;
		$list = $this -> _get_list('mch',$where,'id desc');
		$etime = strtotime('today');
		$stime = $etime - 86400;
		
		foreach($list as $k=>$v){
			$list[$k]['zcharge'] = M('charge')->where(array('mch'=>$v['id'],'create_time'=>array(array('egt',$stime),array('elt',$etime)),'status'=>2))->sum('money');
			$list[$k]['jcharge'] = M('charge')->where(array('mch'=>$v['id'],'create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2))->sum('money');
			$list[$k]['allcharge'] = M('charge')->where(array('mch'=>$v['id'],'status'=>2))->sum('money');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//推广员主页
	public function indes(){
		$where['type'] = 2;
		$list = $this -> _get_list('mch',$where,'id desc');
		$etime = strtotime('today');
		$stime = $etime - 86400;
		
		foreach($list as $k=>$v){
			$list[$k]['zcharge'] = M('charge')->where(array('mch'=>$v['id'],'create_time'=>array(array('egt',$stime),array('elt',$etime)),'status'=>2))->sum('money');
			$list[$k]['jcharge'] = M('charge')->where(array('mch'=>$v['id'],'create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2))->sum('money');
			$list[$k]['allcharge'] = M('charge')->where(array('mch'=>$v['id'],'status'=>2))->sum('money');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	public function edit(){
		if(IS_POST){
			$_POST['tpass'] = $_POST['pass'];
			$_POST['pass'] = xmd5($_POST['pass']);
			
			if(!$_GET['id']){
				if(M('mch')->where(array('username'=>$_POST['username']))->find()){
					$this->error('渠道账号已经存在！');
				}
			}
			
			if(!$_GET['id']){
				$_POST['create_time'] = time();
			}
			if(!$_POST['url']){
				$urlArr = explode('.',$this->_site['url']);
				$str = str_rand(6);
				$_POST['url'] = $str.".".$urlArr[1].".".$urlArr[2];
			}
			$url = "index".$_POST['type'];
		}
		$this->_edit('mch',U('index'));
	}
	
	//推广员编辑
	public function edit2(){
		if(IS_POST){
			$_POST['tpass'] = $_POST['pass'];
			$_POST['pass'] = xmd5($_POST['pass']);
			
			if(!$_GET['id']){
				if(M('mch')->where(array('username'=>$_POST['username']))->find()){
					$this->error('代理账号已经存在！');
				}
				$_POST['create_time'] = time();
				$id = M('mch')->add($_POST);
				$url = "http://".$this->_site['url']."/index.php?mch=".encode($id);
				M('mch')->where(array('id'=>$id))->save(array('url'=>$url,'encode'=>encode($id)));
				$this->success('添加成功！',U('indes'));
			}else{
				M('mch')->where(array('id'=>$_GET['id']))->save($_POST);
				$this->success('修改成功！',U('indes'));
			}
			exit;
		}
		if($_GET['id']>0){
			$this->assign('info',M('mch')->find(intval($_GET['id'])));
		}
		$this->display();
	}

	
	//更新状态
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('mch')->find(intval($id));
			if($info['status'] == -2){
				$status = 1;
			}else{
				$status = $info['status']?0:1;
			}
			M('mch')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->success('更新成功！');
		}else{
			$this->error('非法请求！');
		}
	}
}