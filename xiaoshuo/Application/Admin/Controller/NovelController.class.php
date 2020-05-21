<?php
namespace Admin\Controller;
use Think\Controller;
class NovelController extends CommonController {
   

	//小说列表
	public function index(){
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
		$list = $this->_get_list("anime",$where,'id desc');
		foreach($list as $k=>$v){
			$list[$k]['isend'] = M('chapter')->where(array('mch'=>$this->mch['id'],'anid'=>$v['id']))->find();
			$list[$k]['scount'] = M('chapter')->where(array('mch'=>$this->mch['id'],'anid'=>$v['id']))->count();
			$list[$k]['chapters'] = M('anime_chapter')->where(array('anid'=>$v['id']))->order('chaps asc')->limit(10)->select();
			
		}
		
		$this->assign('list',$list);	
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//文字文案
	public function guide(){
		$id = I('get.id');
		//文案标题
		$titles = M('article')->distinct(true)->field('title')->order('create_time desc')->select();
		$this->assign('titles',$titles);
		//文案图片
		$pics = M('article')->distinct(true)->field('pic')->order('create_time desc')->select();
		$this->assign('pics',M('article')->distinct(true)->field('pic')->order('create_time desc')->select());
		
		//漫画信息
		$info = M('anime')->find(intval($id));
		
		//漫画第一集信息
		$oneInfo = M('anime_chapter')->where(array('anid'=>$id,'chaps'=>1))->find();
		$cpics = explode(",",$oneInfo['info']);
		$this->assign('oneInfo',$oneInfo);
		$this->assign('cpics',$cpics);
		
		//随机取出文案一条图片记录
		$random = rand(0,count($pics)-1);
		$this->assign('coverpic',$pics[$random]['pic']);
		$this->assign('covertitle',$titles[$random]['title']);
		
		//章节标题
		$this->assign('gtitles',C('GTITLES'));
		//阅读原文图片
		$this->assign('yuepics',C('YUEPICS'));
		
		//前十章节标题
		$atitles = M('anime_chapter')->field('chaps,title')->where(array('anid'=>$id))->order('chaps asc')->limit(10)->select();
		$this->assign('atitles',$atitles);
		
		$this->assign('info',$info);
		$this->display();
	}
	
	
	//图片文案
	public function guidePic(){
		$model = I('get.model');
		$id = I('get.id');
		//文案标题
		$titles = M('article')->distinct(true)->field('title')->order('create_time desc')->select();
		$this->assign('titles',$titles);
		//文案图片
		$pics = M('article')->distinct(true)->field('pic')->order('create_time desc')->select();
		$this->assign('pics',M('article')->distinct(true)->field('pic')->order('create_time desc')->select());
		
		//漫画信息
		$info = M('anime')->find(intval($id));
	
		//随机取出文案一条图片记录
		$random = rand(0,count($pics)-1);
		$this->assign('coverpic',$pics[$random]['pic']);
		$this->assign('covertitle',$titles[$random]['title']);
		
		//章节标题
		$this->assign('gtitles',C('GTITLES'));
		//阅读原文图片
		$this->assign('yuepics',C('YUEPICS'));
		
		//多少章节，查看章节是否生成图片
		$chaps = I('get.chaps');
		
		//选择的章节
		$this->assign('ztitle', M('anime_chapter')->where(array('anid'=>$id,'chaps'=>$chaps))->getField('title'));

		for($i = 1;$i<=$chaps;$i++){
			$path = "./Public/chapter/".$id."_".$i.".png";
			$chapter = M('anime_chapter')->where(array('anid'=>$id,'chaps'=>$i))->find();
			if(!is_file($path)){
				$text = str_replace("<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","",$chapter['info']);
				$text = str_replace("</p>","\n",$text);
				$text = str_replace(' ', '', $text);
				$text = str_replace('.', '', $text);

				$config = array(
					'path'=>'./Public/chapter/',
					'file_name'=>$id."_".$i,
					'size'=>18,
					'angle'=>0,
					'fontfile'=>'./Public/home/fonts/simhei.ttf',
					'width'=>700,
					'x'=>40,
					'y'=>100
				);
				$words = new \Common\Util\wordsOnImg($config);
				$words->writeWordsToImg($text,false);
			}
			$img_info = getimagesize($path);
			$imgs[] = array( 
				"title"=>$chapter['title'],
				"path"=>$path,
				"hw"=>($img_info[1]/$img_info[0]*100/2)."%",
			);
			
		}

		$this->assign('imgs',$imgs);
		$this->assign('info',$info);
		
		if($model == 1){
			$this->display();
		}else{
			$this->display("guideDiv");
		}
		
	}
	
	
	
	
	
	//获取正文章节
	public function getChaps(){
		if(IS_POST){
			$chaps = I('post.chaps');//要获得的章节
			$anid = I('post.anid');
			$where = array(
				"anid"=>$anid,
				"chaps"=>array(array('egt',1),array('elt',$chaps)),
			);
			$list = M('anime_chapter')->where($where)->order('chaps asc')->select();
			if($list){
				foreach($list as $k=>$v){
					$list[$k]['cpics'] = explode(",",$v['info']);
				}
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有章节数据！',M()->getLastSql());
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	//生成推广链接
	public function createGuide(){
		if(IS_POST){
			$anid = I('post.anid');
			$chaps = I('post.chaps');
			$name = I('post.name');
			$subchaps = I('post.subchaps');
			$msg = I('post.msg');
			
			$info = M('anime')->find(intval($anid));
			if(!$info || !$anid){
				$this->error('数据错误！');
			}
			$chapter = M('anime_chapter')->where(array('anid'=>$anid,'chaps'=>$chaps))->find();
			$cid = M('chapter')->add(array(
				"btype"=>$info['btype'],
				"mch"=> 0,
				"anid"=>$anid,
				"chaps"=>$chaps,
				"name"=>$name,
				"title"=>$info['title'],
				"atitle"=>$chapter['title'],
				"issub"=>$subchaps?1:0,
				"subchaps"=>$subchaps,
				"msg"=>$msg,
				"create_time"=>time(),
			));
			if($cid){
				$url = "http://".$_SERVER['SERVER_NAME'].__ROOT__."/index.php?m=&c=Index&a=readAnime&anid=".$anid."&chaps=".$chaps."&chapter=".encode($cid);
				M('chapter')->where(array('id'=>$cid))->save(array('url'=>$url));
				$this->createQrcode($cid);
				$this->success('生成成功',U('Nhapter/index'));
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	//生成二维吗
	public function createQrcode($cid){
		if($cid){
			$info = M('chapter')->find(intval($cid));
		}
		if(!$info){
			return;
		}
		
		$path_info = get_qrcode_path(0,$info['anid'],$info['chaps']);
		
		//合成二维码
		if(!is_file($path_info['qrcode'])){
			include COMMON_PATH.'Util/phpqrcode/phpqrcode.php';
			// 目录不存在则创建
			if(!is_dir($path_info['path'])){
				mkdir($path_info['path'], 0777,1);
			}
			$errorCorrectionLevel = 'L';
			$matrixPointSize = 6;
			\QRcode::png($info['url'], $path_info['qrcode'], $errorCorrectionLevel, $matrixPointSize, 2);	
		}
		//漫画背景图
		$bgs = C('QPICS');
		foreach($bgs as $k=>$v){
			$path_info = get_qrcode_path(0,$info['anid'],$info['chaps'],$k);
			$im_dst = imagecreatefromjpeg($v);
			
			$imgsize = getimagesize($path_info['qrcode']);
			if(strpos($imgsize['mime'],'png') !== false){
				$im_src = imagecreatefrompng($path_info['qrcode']);
			}else{
				$im_src = imagecreatefromjpeg($path_info['qrcode']);
			}
			
			$width = $imgsize[0];
			if($k == 0){
				imagecopyresized ( $im_dst, $im_src,215, 25, 0, 0, $width*0.6, $width*0.6, $width, $width);
			}elseif($k == 1){
				imagecopyresized ( $im_dst, $im_src,365, 26, 0, 0, $width*0.72, $width*0.72, $width, $width);
			}elseif($k == 2){
				imagecopyresized ( $im_dst, $im_src,338, 58, 0, 0, $width*0.6, $width*0.6, $width, $width);
			}elseif($k ==3){
				imagecopyresized ( $im_dst, $im_src,100, 25, 0, 0, $width*0.62, $width*0.62, $width, $width);
			}elseif($k == 4){
				imagecopyresized ( $im_dst, $im_src,208, 56, 0, 0, $width*0.63, $width*0.63, $width, $width);
			}
			// 保存
			imagejpeg($im_dst, $path_info['new']);
			// 销毁
			imagedestroy($im_src);
			imagedestroy($im_dst);
		}
	}
	
	//获取前十章节
	public function getAnime(){
		if(IS_POST){
			$id = I('post.id');
			$info = M('anime')->find(intval($id));
			if(!$info){
				$this->error('数据错误！');
			}
			$list = M('anime_chapter')->where(array('anid'=>$id))->order('chaps asc')->limit(10)->select();
			$this->success($list);
		}else{
			$this->error('非法请求！');
		}
	}
}