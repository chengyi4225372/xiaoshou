<?php
namespace Admin\Controller;
use Think\Controller;
class SellerController extends CommonController {
   

	//列表
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}

		$this->_list("seller",$where,'id desc');
	}
	
	
	//编辑和添加
	public function edit(){
		if(IS_POST){
			$banner = "";
			for($i=1;$i<6;$i++){
				if($_POST['banner'.$i]){
					$banner[] = $_POST['banner'.$i];
				}
			}
			$_POST['banner'] = implode(",",$banner);
						
			if($_POST['id']>0){ //修改
				M('seller')->where(array('id'=>$_POST['id']))->save($_POST);
			}else{ //增加
				$_POST['create_time'] = NOW_TIME;
				M('seller')->add($_POST);
			}
			$this->success('操作成功！',U('index'));
			exit;
		}
		if($_GET['id']){
			$info = M('seller')->find(intval($_GET['id']));
			$banner = explode(',',$info['banner']);
			foreach($banner as $k=>$v){
				$imgs[$k+1] = $v;
			}
			$this->assign('imgs',$imgs);
			$this->assign('info',$info);
		}
		$this->display();
	}
	
	//更新状态
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('seller')->find(intval($id));
			$status = $info['status']?0:1;
			M('seller')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//购买记录
	public function record(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['create_time'] = array(
				array('gt', strtotime($_GET['time1'])),
				array('lt', strtotime($_GET['time2']) + 86400)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['create_time'] = array('gt', strtotime($_GET['time1']));
		}
		elseif(!empty($_GET['time2'])){
			$where['create_time'] = array('lt', strtotime($_GET['time2'])+86400);
		}
		if(!empty($_GET['user_id'])){
			$where['user_id'] = array('like','%'.$_GET['user_id'].'%');
		}
		$this->_list('user_seller',$where,'create_time desc');
	}
}