<?php
namespace Admin\Controller;
use Think\Controller;
class BookController extends CommonController {
   

	//漫画列表
	public function caric(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['isnew'])){
			$where['isnew'] = intval($_GET['isnew']);
		}
		if(!empty($_GET['islong'])){
			$where['islong'] = intval($_GET['islong']);
		}
		if(!empty($_GET['issex'])){
			$where['issex'] = intval($_GET['issex']);
		}
		if(!empty($_GET['iswz'])){
			$where['iswz'] = intval($_GET['iswz']);
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 1;
		$where['status'] = 1;
		$this->_list("anime",$where,'id desc');
	}
	
	//添加修改漫画
	public function editCaric(){
		if(IS_POST){			
			$post = I('post.');
			//修改
			if($post['id']>0 && isset($post['id'])){
				$rs = M('anime') -> where(array('id'=>intval($post['id']))) -> save($post);
				$this->success('修改成功！',U('caric'));
			}else{
				unset($post['file']);
				$post['create_time'] = date('Y-m-d H:i:s');
				$anid = M('anime')->add($post);
				if($anid){
					//若上传了分集压缩包
					if(!empty($_FILES['file'])){
						 $upload = new \Think\Upload();
						 $upload->maxSize   =     200*1024*1024 ;
						 $upload->exts      =     array('zip','rar');
						 $upload->rootPath  =     './Public/books/';
						 $upload->savePath  =     xmd5(time().rand()).'/';
						 $upload ->autoSub = false;
						 $info   =   $upload->upload();
						 if($info){
							$info = $info['file'];
							// 解压
							$path = $upload->rootPath . $info['savepath'];
							$file = $path . $info['savename'];		
							if(file_exists($file)){
								// 打开压缩文件
								$zip = new \ZipArchive();
								$rs = $zip -> open($file);
								if($rs && $zip -> extractTo($path)){
									$zip -> close();
									//解压完成之后删除
									unlink($file);
								}else{
									$this -> error('解压失败!');
								}
							}else{
								$this -> error('系统没找到上传的文件');
							}
						}else {
							$this -> error('上传错误');
						}
						$this->addChapter($path,$anid,1);
						$this -> success('操作成功！', U('caric'));
						exit;
					}
				}else{
					$this->error('添加失败，请重试！');
				}
			}
		}
		if($_GET['id']>0){
			$this->assign('info',M('anime')->find(intval($_GET['id'])));
		}
		$this->display();
	}
	
	
	//小说列表
	public function novel(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['isnew'])){
			$where['isnew'] = intval($_GET['isnew']);
		}
		if(!empty($_GET['islong'])){
			$where['islong'] = intval($_GET['islong']);
		}
		if(!empty($_GET['issex'])){
			$where['issex'] = intval($_GET['issex']);
		}
		if(!empty($_GET['iswz'])){
			$where['iswz'] = intval($_GET['iswz']);
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 2;
		$where['status'] = 1;
		$this->_list("anime",$where,'id desc');
	}
	
	//添加修改小说
	public function editNovel(){
		if(IS_POST){			
			$post = I('post.');
			//修改
			if($post['id']>0 && isset($post['id'])){
				$rs = M('anime') -> where(array('id'=>intval($post['id']))) -> save($post);
				$this->success('修改成功！',U('novel'));
			}else{
				unset($post['file']);
				$post['create_time'] = date('Y-m-d H:i:s');
				$anid = M('anime')->add($post);
				if($anid){
					//若上传了分集压缩包
					if(!empty($_FILES['file'])){
						 $upload = new \Think\Upload();
						 $upload->maxSize   =     200*1024*1024 ;
						 $upload->exts      =     array('txt');
						 $upload->rootPath  =     './Public/books/';
						 $upload->savePath  =     xmd5(time().rand()).'/';
						 $upload ->autoSub = false;
						 $info   =   $upload->upload();
						 if($info){
							$info = $info['file'];
							// 解压
							$path = $upload->rootPath . $info['savepath'];
							$file = $path . $info['savename'];
						}else {
							$this -> error('上传错误');
						}
						$this->addChapter($file,$anid,$post['btype']);
						$this -> success('操作成功！', U('novel'));
						exit;
					}
				}else{
					$this->error('添加失败，请重试！');
				}
			}
		}
		if($_GET['id']>0){
			$this->assign('info',M('anime')->find(intval($_GET['id'])));
		}
		$this->display();
	}
	
	
	
	
	//漫画列表
	public function story(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['isnew'])){
			$where['isnew'] = intval($_GET['isnew']);
		}
		if(!empty($_GET['islong'])){
			$where['islong'] = intval($_GET['islong']);
		}
		if(!empty($_GET['issex'])){
			$where['issex'] = intval($_GET['issex']);
		}
		if(!empty($_GET['iswz'])){
			$where['iswz'] = intval($_GET['iswz']);
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 3;
		$where['status'] = 1;
		$this->_list("anime",$where,'id desc');
	}
	
	//添加修改听书
	public function editStory(){
		if(IS_POST){			
			$post = I('post.');
			//修改
			if($post['id']>0 && isset($post['id'])){
				$rs = M('anime') -> where(array('id'=>intval($post['id']))) -> save($post);
				$this->success('修改成功！',U('story'));
			}else{
				unset($post['file']);
				$post['create_time'] = date('Y-m-d H:i:s');
				$anid = M('anime')->add($post);
				if($anid){
					//若上传了分集压缩包
					if(!empty($_FILES['file'])){
						 $upload = new \Think\Upload();
						 $upload->maxSize   =     200*1024*1024 ;
						 $upload->exts      =     array('zip','rar');
						 $upload->rootPath  =     './Public/books/';
						 $upload->savePath  =     xmd5(time().rand()).'/';
						 $upload ->autoSub = false;
						 $info   =   $upload->upload();
						 if($info){
							$info = $info['file'];
							// 解压
							$path = $upload->rootPath . $info['savepath'];
							$file = $path . $info['savename'];		
							if(file_exists($file)){
								// 打开压缩文件
								$zip = new \ZipArchive();
								$rs = $zip -> open($file);
								if($rs && $zip -> extractTo($path)){
									$zip -> close();
									//解压完成之后删除
									unlink($file);
								}else{
									$this -> error('解压失败!');
								}
							}else{
								$this -> error('系统没找到上传的文件');
							}
						}else {
							$this -> error('上传错误');
						}
						$this->addChapter($path,$anid,3);
						$this -> success('操作成功！', U('story'));
						exit;
					}
				}else{
					$this->error('添加失败，请重试！');
				}
			}
		}
		if($_GET['id']>0){
			$this->assign('info',M('anime')->find(intval($_GET['id'])));
		}
		$this->display();
	}
	
	
	//上传续集
	public function sequel(){
		if(IS_POST){
			$anid = I('post.anid');
			$type = I('post.type');

			//若上传了分集压缩包
			if(!empty($_FILES['file'])){
				 $upload = new \Think\Upload();
				 $upload->maxSize   =     200*1024*1024 ;
				 $upload->exts      =     array('txt');
				 $upload->rootPath  =     './Public/books/';
				 $upload->savePath  =     xmd5(time().rand()).'/';
				 $upload ->autoSub = false;
				 $info   =   $upload->upload();
				 if($info){
					$info = $info['file'];
					// 解压
					$path = $upload->rootPath . $info['savepath'];
					$file = $path . $info['savename'];		
				}else {
					$this -> error('上传错误');
				}
				$this->addChapter($file,$anid,$type);
				$this -> success('操作成功！');
				exit;
			}else{
				$this->error('上传错误');
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	public function addChapter($path,$anid,$type){
		header("Content-type:text/html;charset=utf-8");
		$allchapter = M('anime')->where(array('id'=>$anid))->getField('allchapter');
		$btxt = file_get_contents($path);
		$bArr = explode("###",trim($btxt));
		//去掉第一章节的###数组
		unset($bArr[0]);
		
		$i = $allchapter?($allchapter+1):1;
		file_put_contents('log.txt',var_export($bArr,1));
		foreach($bArr as $k=>$v){
			$tArr = explode("\r\n",$v);
			$title = $tArr[0];
			unset($tArr[0]);
			$info = implode("",$tArr);
			$info = preg_replace('/\s+/','',$info);
			$info = "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$info;
			$info = str_replace("。","<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$info);
			$ds = array(
				"anid"=>$anid,
				"title"=>$title,
				"chaps"=>$i,
				"info"=>$info,
				"create_time"=>time(),
			);
			M('anime')->where(array('id'=>$anid))->save(array('allchapter'=>$i));
			M('anime_chapter')->add($ds);
			$i++;
		}
		@unlink($path);		
	}
	
	
	//查看分集
	public function lookChaps(){
		$info = M('anime')->find($_GET['id']);
		$this->assign('info',$info);
		$this->_list('anime_chapter',array('anid'=>$_GET['id']),'chaps asc');
	}
		
	
	//更新状态
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('anime')->find(intval($id));
			$status = $info['status']?0:1;
			M('anime')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	//更新是否显示
	public function setShow(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('anime')->find(intval($id));
			$ishow = $info['ishow']?0:1;
			M('anime')->where(array('id'=>$id))->save(array('ishow'=>$ishow));
			$this->success('操作成功！',M()->getLastSql());
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//更新分集标题和封面
	public function setChapter(){
		if(IS_POST){
			$id = I('post.id');
			$title = I('post.title');
			$coverpic = I('post.coverpic');		
			$info = I('post.info');
			
			$save = array();
			if($title){
				$save['title'] = $title;
			}
			if($coverpic){
				$save['coverpic'] = $coverpic;
			}
			if($info){
				$save['info'] = $info;
			}
			if(!empty($save)){
				M('anime_chapter')->where(array('id'=>$id))->save($save);
				$this->success('操作成功！');
			}else{
				$this->error('输入错误！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//漫画回收列表
	public function caricRecover(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 1;
		$where['status'] = 0;
		$this->_list("anime",$where,'id desc');
	}
	
	//小说回收列表
	public function novelRecover(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 2;
		$where['status'] = 0;
		$this->_list("anime",$where,'id desc');
	}
	
	
	//听书回收列表
	public function storyRecover(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 3;
		$where['status'] = 0;
		$this->_list("anime",$where,'id desc');
	}
	
	
	//漫画评论信息
	public function caricComments(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 1;
		$this->_list('comments',$where,'create_time desc');
	}
	
	//小说评论信息
	public function novelComments(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 2;
		$this->_list('comments',$where,'create_time desc');
	}
	
	//听书评论信息
	public function storyComments(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like','%'.$_GET['title'].'%');
		}
		$where['btype'] = 3;
		$this->_list('comments',$where,'create_time desc');
	}
	
	
	//更新评论状态
	public function setCommentsStatus(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('comments')->find(intval($id));
			$status = $info['status']?0:1;
			M('comments')->where(array('id'=>$id))->save(array('status'=>$status));
			if($status == 1){
				M('anime')->where(array('id'=>$info['anid']))->setInc('comments',1);
			}else{
				M('anime')->where(array('id'=>$info['anid']))->setDec('comments',1);
			}
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');
		}
	}
}