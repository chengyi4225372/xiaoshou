<?php
namespace Mch\Controller;
use Think\Controller;
class CustomController extends CommonController {
   
    //客服消息列表
	public function index(){
		$where['mch'] = $this->mch['id']?$this->mch['id']:0;
		$this->_list('custom',$where,'create_time desc');
	}
	
	
	//增加客服消息
	public function add(){
		$id = I('get.id');
		$info = M('anime')->find(intval($id));
		$this->assign('info',$info);
		//文案标题
		$titles = M('article')->distinct(true)->field('title')->order('create_time desc')->select();
		$this->assign('titles',$titles);
		$this->assign('titles_arr',json_encode($titles));
		//文案图片
		$pics = M('article')->distinct(true)->field('pic')->order('create_time desc')->select();
		foreach($pics as $k=>$v){
			$pics[$k]['pic'] = complete_url($v['pic']);
		}
		$this->assign('pics',$pics);
		$this->assign('pics_arr',json_encode($pics));
		
		$rand = rand(0,count($titles)-1);
		$this->assign('random',$rand);
		
		//属于我的用户人数
		$this->assign('persons',M('user')->where(array('mch'=>$this->mch['id']))->count());
		
		$this->display();
	}
	
	
	//查看客服消息
	public function customShow(){
		$id = I('get.id');
		$info = M('custom')->find(intval($id));
		$items = json_decode($info['info'],1);
		
		$this->assign('info',$info);
		$this->assign('items',$items);
		$this->display();
	}
	
	
	//修改客服消息
	public function edit(){
		$id = I('get.id');
		$info = M('custom')->find(intval($id));
		$items = json_decode($info['info'],1);
		
		$this->assign('info',$info);
		$this->assign('items',$items);
		
		//文案标题
		$titles = M('article')->distinct(true)->field('title')->order('create_time desc')->select();
		$this->assign('titles',$titles);
		$this->assign('titles_arr',json_encode($titles));
		//文案图片
		$pics = M('article')->distinct(true)->field('pic')->order('create_time desc')->select();
		foreach($pics as $k=>$v){
			$pics[$k]['pic'] = complete_url($v['pic']);
		}
		$this->assign('pics',$pics);
		$this->assign('pics_arr',json_encode($pics));
		
		$this->display();
	}
	
	
	//获取多久之后的时间
	public function getNowAfter(){
		if(IS_POST){
			$time = I('post.time');
			if($time>=60){
				$time = $time/60;
				$time = time() + $time * 3600;
			}else{
				$time = time() + $time * 60;
			}
			$this->success(date('Y-m-d H:i:s',$time));
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//获取粉丝数量
	public function getUserCount(){
		if(IS_POST){
			$sex = I('post.sex');
			$charge = I('post.charge');
			$money = I('post.money');
			$join_time = I('post.join_time');
			if($sex && $sex>0){
				if($sex == 3){
					$where['sex'] = 0;
				}else{
					$where['sex'] = $sex;
				}
			}
			if($charge && $charge>0){
				if($charge == 1){
					$where['charge_total'] = array('gt',0);
				}else{
					$where['charge'] = 0;
				}
			}
			if($money && $money>0){
				if($money == 1){
					$where['money'] = array('lt',500);
				}elseif($money == 2){
					$where['money'] = array('lt',2000);
				}else{
					$where['money'] = array('lt',5000);
				}
			}
			if($join_time && $join_time>0){
				if($join_time == 1){
					$where['join_time'] = array('egt',strtotime(date('Y-m-d')));
				}elseif($join_time == 2){
					$where['join_time'] = array('egt',strtotime(date("Y-m-d", strtotime("-1 week"))));
				}elseif($join_time == 3){
					$where['join_time'] = array('egt',strtotime("-15 day"));
				}elseif($join_time == 4){
					$where['join_time'] = array('egt',strtotime("-1 month"));
				}elseif($join_time == 5){
					$where['join_time'] = array('egt',strtotime("-3 month"));
				}
			}
			$where['mch'] = $this->mch['id']?$this->mch['id']:0;
			$count = M('user')->where($where)->count();
			$this->success($count);
		}else{
			$this->error('非法请求！');
		}
	}
	
	//保存和发送客服消息
	public function sendCustom(){
		if(IS_POST){
			$post = $_POST;
			$post['mch'] = $this->mch['id']?$this->mch['id']:0;
			$post['create_time'] = time();
			if($post['type'] == 1){
				$user = M('user')->find(intval($post['user_id']));
				$info = $post['info'];
				$msgs[0] = array(
					'title' => $post['title'],
					'description' => $post['remark'],
					'picurl' => $post['pic'],
					'url' => $post['url'],
				);
				$info = json_decode($info,1);
				if(is_array($info)){
					foreach($info as $k=>$v){
						$msgs[$k+1] = array(
							'title' => $v['title'],
							'description' => $post['remark'],
							'picurl' => $v['picurl'],
							'url' => $v['url'],
						);
					}
				}

				if(send_msg($this->_mp,$user['openid'],$msgs,'news')){
					$this->success('发送成功！');
				}else{
					$this->error('发送失败！');
				}
			}elseif($post['type'] == 2){//新增
				$post['stime'] = strtotime($post['stime']);
				$id = M('custom')->add($post);
				if($id){
					$this->success('保存成功！',U('index'));
				}else{
					$this->error('保存失败！');
				}
			}elseif($post['type'] ==3){//修改
				$post['stime'] = strtotime($post['stime']);
				if(M('custom')->where(array('id'=>$post['id']))->save($post)){
					$this->success('保存成功！',U('index'));
				}else{
					$this->error('保存失败！');
				}
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//添加活动客服消息
	public function activity(){
		$id = I('get.id');
		$info = M('mch_activity')->find(intval($id));
		$this->assign('info',$info);
		
		//文案标题
		$titles = M('article')->distinct(true)->field('title')->order('create_time desc')->select();
		$this->assign('titles',$titles);
		$this->assign('titles_arr',json_encode($titles));
		//文案图片
		$pics = M('article')->distinct(true)->field('pic')->order('create_time desc')->select();
		foreach($pics as $k=>$v){
			$pics[$k]['pic'] = complete_url($v['pic']);
		}
		$this->assign('pics',$pics);
		$this->assign('pics_arr',json_encode($pics));

		
		//属于我的用户人数
		$this->assign('persons',M('user')->where(array('mch'=>$this->mch['id']))->count());
		
		$this->display();
	}
}