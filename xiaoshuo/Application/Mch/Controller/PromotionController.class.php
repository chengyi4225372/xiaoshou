<?php
namespace Mch\Controller;
use Think\Controller;
class PromotionController extends CommonController {
   
	public function index(){
		$list = C('PROMOTION');
		
		//这里的状态反着来 ，如果在promotion表内找到数据，则表示该代理的推送被禁用
		foreach($list as $k=>$v){
			$info = M('promotion')->where(array('mch'=>$this->mch['id'],'promotionid'=>$k))->find();
			if($info){
				$list[$k]['status'] = 0;
			}else{
				$list[$k]['status'] = 1;
			}
		}
		$this->assign('list',$list);
		$this->display();
	}
	
	
	//设置代理是否禁用推送
	public function setPromotion(){
		if(IS_POST){
			$promotion = I('post.id');
			$info = M('promotion')->where(array('mch'=>$this->mch['id'],'promotionid'=>$promotion))->find();
			//如果有禁用则删除
			if($info){
				M('promotion')->where(array('mch'=>$this->mch['id'],'promotionid'=>$promotion))->delete();
				$this->ajaxReturn(array('status'=>1,'info'=>'操作成功！'));
			}else{ // 如果没有禁用则添加
				M('promotion')->add(array(
					"mch"=>$this->mch['id'],
					"promotionid"=>$promotion,
				));
				$this->ajaxReturn(array('status'=>2,'info'=>'操作成功！'));
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
}