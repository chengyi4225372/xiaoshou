<?php
namespace Mch\Controller;
use Think\Controller;
class ChapterController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		if(!empty($_GET['name'])){
			$where['name'] = array('like','%'.$_GET['name'].'%');
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
		$where['status'] = 1;
		$where['btype'] = 1;
		$where['mch'] = $this->mch['id'];
		$list = $this->_get_list('chapter',$where,'create_time desc');
		foreach($list as $k=>$v){
			$path = get_qrcode_path($this->mch['id'],$v['anid'],$v['chaps'],0);
			$list[$k]['qrcode'] = $path['qrcode'];
			$list[$k]['pqrcode'] = $path['new'];
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//订单明细
	public function charges(){
		$id = I('get.id');
		$this->assign('info',M('chapter')->find($id));
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['sn'])){
			$where['sn'] = array('like','%'.$_GET['sn'].'%');
		}
		if(!empty($_GET['status'])){
			$where['status'] = $_GET['status'];
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
		
		$where['chapter'] = $id;
		
		$list = $this->_get_list('charge',$where,'create_time');
		foreach($list as $k=>$v){
			$list[$k]['user'] = M('user')->find(intval($v['user_id']));
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	
	//修改推广链接
	public function editChapter(){
		$this->_edit("chapter");
	}
	
	//链接回收
	public function delList(){
		$btype = 1;
		$where['btype'] = $btype;
		$where['status'] = 0;
		$where['mch'] = $this->mch['id'];
		$this->_list('chapter',$where,'update_time desc');
	}
	
	//链接还原
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			M('chapter')->where(array('id'=>$id))->save(array('status'=>1,'update_time'=>time()));
			$this->success('还原成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	//生成短链接
	public function shortUrl(){
		if(IS_POST){
			$id = I('post.id');
			$chapter = M('chapter')->find(intval($id));
			$short = getSinaShortUrl($chapter['url']);
			M('chapter')->where(array('id'=>$id))->save(array('shorturl'=>$short));
			$this->success($short);
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	
	//群链接
	public function allChapter(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		$where['btype'] = 1;
		$where['status'] = 1;
		$list = $this->_get_list("anime",$where,'id desc');
		foreach($list as $k=>$v){
			$chapter = M('mch_chapter')->where(array('mch'=>$this->mch['id'],'anid'=>$v['id']))->find();
			$list[$k]['url'] = $chapter['url'];
			$list[$k]['shorturl'] = $chapter['shorturl'];
		}
		$this->assign('list',$list);	
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//创建链接
	public function createChapter(){
		if(IS_POST){
			$id = I('post.id');
			$url = "http://".$_SERVER['SERVER_NAME'].__ROOT__."/index.php?m=&c=Index&a=readAnime&anid=".$id."&chaps=1&mch=".encode($this->mch['id']);
			$short = getSinaShortUrl($url);
			M('mch_chapter')->add(array(
				"mch"=>$this->mch['id'],
				"anid"=>$id,
				"url"=>$url,
				"shorturl"=>$short,
			));
			$this->success('创建成功，页面将重新刷新！');
		}else{
			$this->error('非法请求！');
		}
	}
	
}