<?php
namespace Admin\Controller;
use Think\Controller;
class ActivityController extends CommonController {
   
	public function index(){
		
		$this -> assign('nowtime',time());
		$this -> _list('activity',$where,'create_time desc');
	}
	
	public function edit(){
		if(IS_POST){
			$id = $_POST['id'];
			$_POST['isshow'] = $_POST['isshow']?$_POST['isshow']:0;
			$_POST['stime'] = strtotime($_POST['stime']);
			$_POST['etime'] = strtotime($_POST['etime']);
			if($id && $id>0){
				unset($_POST['id']);
				//修改
				M('activity')->where(array('id'=>$id))->save($_POST);
				M('mch_activity')->where(array('actid'=>$id))->save($_POST);
				$this->success('修改成功！',U('index'));
			}else{
				$_POST['create_time'] = NOW_TIME;
				//添加
				$actid = M('activity')->add($_POST);
				//添加代理活动表数据
				$mch = M('mch')->select();
				foreach($mch as $v){
					$_POST['actid'] = $actid;
					$_POST['mch'] = $v['id'];
					M('mch_activity')->add($_POST);
				}
				$this->success('添加成功！',U('index'));
			}
		}
		$id = $_GET['id'];
		if(isset($id) && $id>0){			
			$this->assign('info',M('activity')->find(intval($id)));
		}
		$this->display();
	}
	
	
	//更新状态
	public function setFieldStatus(){
		if(IS_POST){
			$id = I('post.id');
			$field = I('post.field');
			$info = M('activity')->find(intval($id));
			$status = $info[$field]?0:1;
			if($field == "status"){
				M('mch_activity')->where(array('actid'=>$id))->save(array('status'=>$status));
			}
			M('activity')->where(array('id'=>$id))->save(array($field=>$status));
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
}