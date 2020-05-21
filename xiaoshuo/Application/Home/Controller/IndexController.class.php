<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	
	
	// 漫画首页
    public function index(){
	    $mchcode = I('get.mch');
		
		//初始化默认男生
		$where['issex'] = 1;
		if($_GET['order'] == "sex2"){
			$where['issex'] = 2;
		}
		
		//发布区域数据
		foreach($this->_xsArea as $k=>$v){
            //dump($v);
			$where['btype'] = 2;
			$where["_string"] = 'FIND_IN_SET('.$k.',areas)';
			$where['status'] = 1;
			$where['ishow']  = 1;
			$where['isbg']   = 1;
			$anime = M('anime')->where($where)->order('sort desc')->limit(4)->select();

            $map['btype']   = 2;
			$map['isbg']    = 2;
            $map['status']  = 1;
            $map['ishow']   = 1;
            $map['areas']   = $k;
            $anime2 = M('anime')->where($map)->order('sort desc')->limit(1)->select();
            //dump(M('anime')->_sql());

			$list[] = array(
				"sid"=>$k,
				"name"=>$v,
				"list"=>$anime,
                "list2"=>$anime2,
			);
		}
        $mhStore =$this->_mhStore;
		$this->assign('list',$list);
        $this->assign('mhStore',$mhStore);
		//免费漫画数据
        //$noPay = M('anime')->where(array('isfw'=>2,'btype'=>1,'status'=>1,'ishow'=>1))->order('sort desc')->limit(6)->select();
		$noPay = M('anime')->where(array('isfw'=>2,'btype'=>2,'status'=>1,'ishow'=>1))->order('sort desc')->limit(6)->select();
		$this->assign('noPay',$noPay);
		$guess = M('anime')->where(array('btype'=>2,'status'=>1,'ishow'=>1))->order('rand()')->limit(6)->select();
		$this->assign('guess',$guess);
				
    
		//查询阅读记录
		$history = M('readhistory')->where(array('user_id'=>$this->user['id'],'ismax'=>2,'btype'=>1))->order('create_time desc')->limit(6)->select();
		foreach($history as $k=>$v){
			$anime =  M('anime')->where(array('id'=>$v['anid']))->find();
			$history[$k]['remark'] = $anime['remark'];
			$history[$k]['selectpic'] = $anime['selectpic'];
		}
		$this->assign('history',$history);
		//听书
		$this->assign('tings', M('anime')->where(array('btype'=>2))->order('sort desc')->select());
		
		
		$mch =  M('mch')->where(array('encode'=>$mchcode))->find();

		$this->assign('mch',$mch);
		$this->display($this->tpl);
    }
	
	
    public function  get_other_books(){
        if (IS_POST) {
            $btype = I('post.type');
            $list = M('anime')->where(array('btype' => $btype, 'status' => 1, 'ishow' => 1))->order('rand()')->limit(6)->select();
            $html = '';
            if ($list) {
                foreach ($list as $k => $v) {
                    $url = U('Index/info',array('id'=>$v['id']));
                    $url = complete_url($url);
                    $html .= '<li>';
                    $html .= '<a href="'.$url.'">';
                    $html .= '<img src="' . $v['infopic'] . '">';
                    $html .= '<i class="icon-free"></i>';
                    $html .= '<p>' . $v['title'] . '</p>';
                    $html .= '</a>';
                    $html .= '</li>';
                }
                $this->ajaxReturn(array('status' => 1, 'info' => $html));
            } else {
                $this->ajaxReturn(array('status' => 2, 'info' => '没有'));
            }
        }
    }
	//小说首页
	public function novel(){
		//发布区域数据
		foreach($this->_xsArea as $k=>$v){
			$where['btype'] = 2;
			$where["_string"] = 'FIND_IN_SET('.$k.',areas)';
			$where['status'] = 1;
			$where['ishow'] = 1;
			$where['isbg']   = 1;

            $map['btype']   = 2;
            $map['isbg']    = 2;
            $map['status']  = 1;
            $map['ishow']   = 1;
            $map['areas']   = $k;
            $anime2 = M('anime')->where($map)->order('sort desc')->limit(1)->select();
            //$anime = M('anime')->where($where)->order('sort desc')->limit(4)->select();
			$anime = M('anime')->where($where)->order('sort desc')->limit(4)->select();
			$list[] = array(
				"sid"=>$k,
				"name"=>$v,
				"list"=>$anime,
                "list2"=>$anime2,
			);
		}
		$this->assign('list',$list);

		//免费漫画数据
		$noPay = M('anime')->where(array('isfw'=>2,'btype'=>2,'status'=>1,'ishow'=>1))->order('sort desc')->limit(4)->select();
		$this->assign('noPay',$noPay);
		
		$guess = M('anime')->where(array('btype'=>2,'status'=>1,'ishow'=>1))->order('rand()')->limit(4)->select();
		$this->assign('guess',$guess);
				
 
		//查询阅读记录
		$history = M('readhistory')->where(array('user_id'=>$this->user['id'],'ismax'=>2,'btype'=>2))->order('create_time desc')->limit(6)->select();
		foreach($history as $k=>$v){
			$anime =  M('anime')->where(array('id'=>$v['anid']))->find();
			$history[$k]['remark'] = $anime['remark'];
			$history[$k]['selectpic'] = $anime['selectpic'];
		}
	    $xsStore =$this->_xsStore;
        $this->assign('xsStore',$xsStore);
		$this->assign('history',$history);
		
		$this -> display($this->tpl);
	}
	
	// 听书首页
    public function story(){
		
		//发布区域数据
		foreach($this->_stArea as $k=>$v){
			$where['btype'] = 3;
			$where["_string"] = 'FIND_IN_SET('.$k.',areas)';
			$where['status'] = 1;
			$where['ishow'] = 1;
			$anime = M('anime')->where($where)->order('sort desc')->limit(6)->select();
			$list[] = array(
				"sid"=>$k,
				"name"=>$v,
				"list"=>$anime,
			);
		}
	   // dump($list);
		$this->assign('list',$list);
		
		//免费数据
		$noPay = M('anime')->where(array('isfw'=>2,'btype'=>3,'status'=>1,'ishow'=>1))->order('sort desc')->select();
		$this->assign('noPay',$noPay);
		
		
		$stStore =$this->_stStore;
        $this->assign('stStore',$stStore);
		//查询阅读记录
		$history = M('readhistory')->where(array('user_id'=>$this->user['id'],'ismax'=>2,'btype'=>3))->order('create_time desc')->limit(6)->select();
		$this->assign('history',$history);

		$this->display($this->tpl);
    }
	
	
	//漫画小说详情
	public function info(){
		$id = I('get.id');
		$info = M('anime')->find(intval($id));
		$this->assign('info',$info);
		$this->assign('mtitle','书籍详情');
		//查询是否已收藏
		$collect = M('collect')->where(array('user_id'=>$this->user['id'],'anid'=>$id))->find();
		$this->assign('collect',$collect);
		
		//查询前3章和最后一章
		$info_chapter = M('anime_chapter')->where(array('anid'=>$id))->order('chaps asc')->limit(3)->select();
		$inchapter = M('anime_chapter')->where(array('anid'=>$id))->order('chaps desc')->limit(1)->find();
		$this->assign('info_chapter',$info_chapter);
		$this->assign('inchapter',$inchapter);
		//猜你喜欢随机选择6个不为自己ID
		$guess = M('anime')->where(array('id'=>array('neq',$id),'btype'=>$info['btype'],'status'=>1))->order('rand()')->limit(4)->select();
		$this->assign('guess',$guess);
		
		//查询五条评论
		$this->assign('comments',M('comments')->where(array('anid'=>$id,'status'=>1))->order('create_time desc')->limit(5)->select());
		
		//打赏人数
		$this->assign('prizeNums',M('user_prize')->where(array('anid'=>$id))->count());
		$this->assign('prizeList',M('user_prize')->where(array('anid'=>$id))->order('prize desc')->limit(3)->select());
		
		$dd = new \Common\Util\ddwechat();
        $dd->setParam($this->_mp);
        $jssdk = $dd->getsignpackage();
        $this->assign('jssdk', $jssdk);

		$this->display($this->tpl);
	}
	
	
	
	
	//听书详情
	public function stInfo(){
		$id = I('get.id');
		$info = M('anime')->find(intval($id));
		$this->assign('info',$info);
		
		//查询是否已收藏
		$collect = M('collect')->where(array('user_id'=>$this->user['id'],'anid'=>$id))->find();
		$this->assign('collect',$collect);
		
		//猜你喜欢随机选择6个不为自己ID
		$guess = M('anime')->where(array('id'=>array('neq',$id),'btype'=>$info['btype']))->order('rand()')->limit(6)->select();
		$this->assign('guess',$guess);
		
		//查询五条评论
		$this->assign('comments',M('comments')->where(array('anid'=>$id,'status'=>1))->order('create_time desc')->limit(5)->select());
		
		//打赏人数
		$this->assign('prizeNums',M('user_prize')->where(array('anid'=>$id))->count());
		$this->assign('prizeList',M('user_prize')->where(array('anid'=>$id))->order('prize desc')->limit(3)->select());
		
		//猜你喜欢随机选择6个不为自己ID
		$guess = M('anime')->where(array('id'=>array('neq',$id),'btype'=>$info['btype']))->order('rand()')->limit(6)->select();
		$this->assign('guess',$guess);
		
		$dd = new \Common\Util\ddwechat();
        $dd->setParam($this->_mp);
        $jssdk = $dd->getsignpackage();
        $this->assign('jssdk', $jssdk);
		
		$this->display($this->tpl);
	}
	
	
	//听书播放
	public function listingStory(){
		$anid = I('get.anid');
		$chaps = I('get.chaps');
		$anime = M('anime')->find(intval($anid));
		$info = M('anime_chapter')->where(array('anid'=>$anid,'chaps'=>$chaps))->find();
		$this->assign('info',$info);
		
		$this->assign('anime',$anime);
		
		$this->display($this->tpl);
	}
	
	
	//漫画小说分集
	public function readAnime(){
		$anid = I('get.anid');
		$chaps = I('get.chaps');
		$anime = M('anime')->find(intval($anid));
		$info = M('anime_chapter')->where(array('anid'=>$anid,'chaps'=>$chaps))->find();
		$this->assign('info',$info);
		$this->assign('anime',$anime);
		
		//当前地址
		$url = get_current_url();
		$this->assign('url',base64_encode($url));
		
		//判断是否有强制关注

		if($this->chapter && $chaps>=$this->chapter['subchaps']){
			if(!$this->user || !$this->user['subscribe']){
				$this->assign('issub',1);
			}
		}
		
		if($this->user){
			//查询是否已收藏
			$collect = M('collect')->where(array('user_id'=>$this->user['id'],'anid'=>$anid))->find();
			$this->assign('collect',$collect);
			
			//查询是否有该书记录
			$reads = M('readhistory')->where(array('anid'=>$anid,'user_id'=>$this->user['id']))->find();
			//查询是否有该章节记录
			$readhistory = M('readhistory')->where(array('anid'=>$anid,'chaps'=>$chaps,'user_id'=>$this->user['id']))->find();
			//增加阅读记录
			if(!$readhistory){
				if(!$reads){
					$ismax = 2;
				}
				M('readhistory')->add(array(
					"mch"=>$this->user["mch"],
					"user_id"=>$this->user['id'],
					"anid"=>$anid,
					"chaps"=>$chaps,
					"title"=>$anime['title'],
					"coverpic"=>$anime['coverpic'],
					"remark"=>$anime['remark'],
					"create_time"=>time(),
					"ismax"=>$ismax?$ismax:1,
					"btype"=>$anime['btype'],
				));
			}
			if($reads){
				M('readhistory')->where(array('user_id'=>$this->user['id'],'anid'=>$anid))->save(array('ismax'=>1));
				M('readhistory')->where(array('user_id'=>$this->user['id'],'anid'=>$anid,'chaps'=>$chaps))->save(array('ismax'=>2));
			}
		}	
		
		//查询代理的关注章节
		if($this->mch){
			$mchsub = M('mch_subscribe')->where(array('mch'=>$this->mch['id'],'anid'=>$anid))->getField('chaps');
			$this->assign('mchsub',$mchsub);
		}
		
		//查询当前章节是否要弹出广告
		$ads = 0;
		if($this->_ads){
			foreach($this->_ads as $k=>$v){
				if($chaps%$v['nums'] == 0){
					$ads = $k;
					break;
				}
			}
		}

		$this->assign('ads',$ads);
		
		
		$dd = new \Common\Util\ddwechat();
        $dd->setParam($this->_mp);
        $jssdk = $dd->getsignpackage();
        $this->assign('jssdk', $jssdk);

		$this->display($this->tpl);

	}
	
	
	//充值
	public function charge(){	
		$this->assign('mtitle','充值');
		$this->display($this->tpl);
	}
	
	
	//收藏记录
	public function collectHistory(){
		$btype = I('get.btype');
		$where = array(
			"user_id"=>$this->user['id'],
		);
		$allcollect= M('collect')->where($where)->count();	
		$this->assign('totalnum',$allcollect);
		$this->assign('mtitle','最近阅读');
        $this->assign('btype',$btype);
		$this -> display($this->tpl);
	}
	
	
	//历史记录
	public function readHistory(){
		$btype = I('get.btype');
			
		$where = array(
			"user_id"=>$this->user['id'],
			"ismax"=>2,//读取出最大章节的记录
		);
		$allread= M('readhistory')->where($where)->count();	
		$this->assign('mtitle','最近阅读');
		$this->assign('totalnum',$allread);
        $this->assign('btype',$btype);
		$this -> display($this->tpl);
	}
	
	
	//分类
	//分类
	public function bookType(){
		$btype = I('get.btype');
		//dump($btype);
		if($btype == 1){
			$this->assign('store',$this->_mhStore);
		}elseif ($btype == 3){
            $this->assign('store',$this->_stStore);
        }else{
			$this->assign('store',$this->_xsStore);
		}
		$this->assign('mtitle','分类');
		$this->assign('btype',$btype);
		$this->display($this->tpl);
	}
	
	//分类详情
	public function BookTypeinfo(){
		$btype = I('get.btype');
		$order = I('get.order');
		$cateids = I('get.cateids');
		//dump($btype);
		if($btype == 1){
			$this->assign('store',$this->_mhStore);
		}elseif ($btype == 3){
            $this->assign('store',$this->_stStore);
        }else{
			$this->assign('store',$this->_xsStore);
		}
		$this->assign('mtitle',$this->_xsStore[$cateids]);
		$this->assign('btype',$btype);
		$this->display($this->tpl);
	}
	
	//更多
	public function moreList(){

		$btype = I('get.btype');
		$field = I('get.field');
		$value = I('get.value');

		if($btype == 1){
			$title = array(
				"areas"=>$this->_mhArea,
				"isfw"=>array(
					"1"=>"付费专区",
					"2"=>"免费漫画",
				),
			);
		}elseif($btype == 2){
			$title = array(
				"areas"=>$this->_xsArea,
				"isfw"=>array(
					"1"=>"付费专区",
					"2"=>"免费小说",
				),
			);
		}else{
			$title = array(
				"areas"=>$this->_stArea,
				"isfw"=>array(
					"1"=>"付费专区",
					"2"=>"免费听书",
				),
			);
		}
        // dump($this->_xsArea);
		$this->assign('mtitle',$title[$field][$value]);
		$this->display($this->tpl);
	}
	
	//个人中心
	public function my(){
		$date = date('Ymd');
		$sign = M('sign')->where(array('date'=>$date,'user_id'=>$this->user['id']))->find();
		$this->assign('sign',$sign);
		
			
		//今日必看数据
		$first = M('anime')->order('sort desc')->find();
		
		//另外三个今日必看数据
		$second = M('anime')->where(array('id'=>array('neq',$first['id'])))->order('sort desc')->limit(3)->select();
		
		$this->assign('first',$first);
		$this->assign('second',$second);
		
		$this -> display($this->tpl);
	}
	
	
	public function Hd(){
	$btype = I('get.btype');
			$btype = I('get.btype');
		
		//dump($btype);
		if($btype == 1){
			$this->assign('store',$this->_mhStore);
		}elseif ($btype == 3){
            $this->assign('store',$this->_stStore);
        }else{
			$this->assign('store',$this->_xsStore);
			
		}
		$this->assign('btype',$btype);
		$this->display($this->tpl);
	}
	
	public function hd2(){
		if(IS_POST){
			$id = I('post.id');
			//dump($id);
			$user = M('user');
			$money = $this->user['money'];
			if($money<20){
				//dump('书币不足');
				//$this->error("您的书币不足，请充值！",U('charge'));
				$arr = array(
			'name'=>'您的书币不足，请充值！',
			'pic'=>'您的书币不足，请充值！',
			'size'=>'您的书币不足，请充值！'
							);
							
			$this->ajaxReturn (json_encode($arr),'JSON');
				
			}else{
				//扣除用户书币
				$data = $user->where(array('id'=>$this->user['id']))->setDec("money",20);
				//dump($money);
				
			}
			
		}
		
				
				
				
			
				
	}
	public function hd3(){
      //增加各项的值。
		if(IS_POST){
			$num = I('post.num');
			$user = M('user');
			if($num==1){
			$data = $user->where(array('id'=>$this->user['id']))-> setInc("money",20);
			}else if($num==2){
			$data = $user->where(array('id'=>$this->user['id']))-> setInc("money",10);
			}else if($num==3){
			$data = $user->where(array('id'=>$this->user['id']))-> setInc("money",15);
			}else if($num==5){
			$data = $user->where(array('id'=>$this->user['id']))-> setInc("money",25);
			}else if($num==6){
			$data = $user->where(array('id'=>$this->user['id']))-> setInc("money",30);
			}else if($num==7){
			$data = $user->where(array('id'=>$this->user['id']))-> setInc("money",500);
			}

		}
		
		
		
	}
	
	//账单明细
	public function report(){	
		$this->display($this->tpl);
	}
	
	
	//搜索
	public function iSearch(){
		$keyword = I("get.keyword");
		if($keyword){
			$where['title'] = array('like','%'.$keyword.'%');
			$list = M('anime')->where($where)->where(array('status'=>1))->order('sort desc')->select();
		}else{
			//获取热门小说
			$list = M('anime')->field('id,title')->where(array('status'=>1))->order('hots desc')->limit(8)->select();
		}
		//猜你喜欢随机选择6个不为自己ID
		$guess = M('anime')->where(array('btype'=>2,'status'=>1))->order('rand()')->limit(4)->select();
		$this->assign('guess',$guess);
		$this->assign('keyword',$keyword);
		$this->assign('list',$list);
		$this->display($this->tpl);
	}
	
	
	
	//修改账号密码
	public function profile(){
		if(IS_POST){
			$post = I('post.');
			$post['psw'] = md5($post['psw']);
			$user = M('user')->where(array('username'=>$post['username']))->find();
			if($user && $user['id']!=$this->user['id']){
				$this->error('该账号已经存在！');
			}
			M('user')->where(array('id'=>$this->user['id']))->save($post);
			$this->success('修改成功！');
		}
		$this->display($this->tpl);
	}
	
	
	//排行榜
	public function rank(){
		$order = I('get.order');
		$mtitle="点击榜";
		if($order){
			if($order == "hots"){
				$order = "hots desc";
			}
			if($order == "time"){
				$order = "id desc";
				$mtitle="畅销榜";
			}
			if($order == "overs"){
				$where['iswz'] = 2;
				$order = "sort desc";
			}
			if($order == "free"){
				$where['isfw'] = 2;
				$order = "sort desc";
			}
			if($order == "sex1"){
				$where['issex'] = 1;
				$order = "sort desc";
			}
			if($order == "sex2"){
				$where['issex'] = 2;
				$order = "sort desc";
			}
		}else{
			$order = "hots desc";
		}
		$where['btype'] = I('get.btype');
		$where['status'] = 1;
    	//$list = M('anime')->where($where)->order($order)->select();
		$this->assign('mtitle',$mtitle);
    	$this->assign('list',$list);
    	$this->display($this->tpl);
	}
	
	
	
	//举报中心
	public function lodge(){
		$anid = I('get.anid');
		if(!$anid){
			$this->error('参数错误！');
		}
		
		$info = M('anime')->find(intval($anid));
		if(!$info){
			$this->error('信息错误！');
		}
		if(IS_POST){
			$jid = I('post.jid');
			if($jid == "seqing"){
				$save = array(
					"seqing"=>array("exp","seqing+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"seqing"=>1,
					"nums"=>1,
					"anid"=>$anid,
					"title"=>$info['title'],
					"btype"=>$info['btype'],
				);
			}
			if($jid == "xuexing"){
				$save = array(
					"xuexing"=>array("exp","xuexing+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"xuexing"=>1,
					"nums"=>1,
					"anid"=>$anid,
					"title"=>$info['title'],
					"btype"=>$info['btype'],
				);
			}
			if($jid == "baoli"){
				$save = array(
					"baoli"=>array("exp","baoli+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"baoli"=>1,
					"nums"=>1,
					"anid"=>$anid,
					"title"=>$info['title'],
					"btype"=>$info['btype'],
				);
			}
			if($jid == "weifa"){
				$save = array(
					"weifa"=>array("exp","weifa+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"weifa"=>1,
					"nums"=>1,
					"anid"=>$anid,
					"title"=>$info['title'],
					"btype"=>$info['btype'],
				);
			}
			if($jid == "daoban"){
				$save = array(
					"daoban"=>array("exp","daoban+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"daoban"=>1,
					"nums"=>1,
					"anid"=>$anid,
					"title"=>$info['title'],
					"btype"=>$info['btype'],
				);
			}
			if($jid == "qita"){
				$save = array(
					"qita"=>array("exp","qita+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"qita"=>1,
					"nums"=>1,
					"anid"=>$anid,
					"title"=>$info['title'],
					"btype"=>$info['btype'],
				);
			}
			if(M('lodge')->where(array('anid'=>$anid))->find()){
				M('lodge')->where(array('anid'=>$anid))->save($save);
			}else{
				M('lodge')->add($add);
			}
			$this->success("举报成功！");
		}
		$url = get_current_url();
		$this->assign('list',C('LODGE'));
		$this->assign('url',$url);
		$this->display($this->tpl);
	}
	
	
	//评论
	public function comments(){
		$info = M('anime')->find(intval(I('get.anid')));
		$this->assign('info',$info);
		
		$where['anid'] = I('get.anid');
		$where['status'] = 1;
		$list = M('comments')->where($where)->order('create_time desc')->select();
		foreach($list as $k=>$v){
			$list[$k]['reply'] = M('comments')->where(array('cid'=>$v['id']))->count();
		}
		$this->assign('list',$list);
		$this->display($this->tpl);
	}
	
	
	//活动列表
	public function activity(){
		if($this->mch && $this->mch['type']!=1){
			$info = M('mch_activity')->where(array('actid'=>I('get.id')))->find();
		}else{
			$info = M('activity')->find(intval(I('get.id')));
		}

		if(!$info || $info['etime']<time() || $info['status']!=1){
			$this->assign('isnoact',1);
		}
		$this->assign('info',$info);
		$this->display($this->tpl);
	}
	
	
	//分享
	public function share(){
		//当前地址
		$id = I('get.id');
		$info = M('anime')->find(intval($id));
		if(!$info || !$id){
			$this->error('数据错误');
		}
		
		$this->assign('info',$info);
		//分享地址,无论第几章都是分享第一张
		
		$url = complete_url(U('Index/readAnime',array('anid'=>$id,'chaps'=>1)));
		$shareUrl = $url.'&shareUser='.encode($this->user['id']);
		$shareUrl = getSinaShortUrl($shareUrl);
		$this->assign('shareUrl',$shareUrl);
		$this->display($this->tpl);
	}
	
	
	//视频
	public function video(){
		
		//发布区域数据
		foreach($this->_vdArea as $k=>$v){
			$where["_string"] = 'FIND_IN_SET('.$k.',areas)';
			$where['status'] = 1;
			$video = M('video')->where($where)->order('sort desc')->select();
			if($video){
				$list[] = array(
					"aid"=>$k,
					"name"=>$v,
					"list"=>$video,
				);
			}
		}
		$this->assign('list',$list);
		
		$this->display($this->tpl);
	}
	
	
	//视频详情
	public function vinfo(){
		//初始化定义
		$videoVip = 0;
		
		$id = I('get.id');
		$info = M('video')->find(intval($id));
		$this->assign('info',$info);
		
		//查看是否已经购买
		$buys = M('user_video')->where(array('user_id'=>$this->user['id'],'vid'=>$id))->find();
		if($buys || $info['isfw'] == 2 || !$info['money'] || $this->user['viptime']!=0){
			$videoVip = 1;
		}
		
		$this->assign('videoVip',$videoVip);
		$this->display($this->tpl);
	}
	
	//视频列表
	public function vlists(){
		if($_GET['areas']){
			$where["_string"] = 'FIND_IN_SET('.$_GET['areas'].',areas)';
			$this->assign('title',$this->_vdArea[$_GET['areas']]);
		}
		if($_GET['cates']){
			$where["_string"] = 'FIND_IN_SET('.$_GET['cates'].',areas)';
			$this->assign('title',$this->_vdStore[$_GET['cates']]['name']);
		}
		$list = M('video')->where($where)->order('sort desc')->select();
		$this->assign('list',$list);
		$this->display($this->tpl);
	}
	
	
	//经典名家
	public function seller(){
		$list = M('seller')->order('sort desc')->select();
		$this->assign('list',$list);
		$this->display($this->tpl);
	}
	
	
	//经典名家详情
	public function sinfo(){
		$id = I('get.sellerid');
		$info = M('seller')->find(intval($id));
		$this->assign('info',$info);
		$imgs = explode(",",$info['banner']);
		$this->assign('imgs',$imgs);
		$this->display($this->tpl);
	}
	
	
	
	//名家经典一件分享
	public function sellerShare(){
		$id = I('get.id');
		$this->assign('info',M('seller')->find(intval($id)));
		
		//分享地址
		$url = complete_url(U('Index/sinfo',array('sellerid'=>$id)));
		$shareUrl = $url.'&sellerUser='.encode($this->user['id']);
		$shareUrl = getSinaShortUrl($shareUrl);
		$this->assign('shareUrl',$shareUrl);
		
		$this->display($this->tpl);
	}
	
	
	//建议反馈
	public function feedBack(){
		$this->display($this->tpl);
	}
	
	
	//我的消息
	public function umsg(){
		$this->display($this->tpl);
	}
	
	//我的消息
	public function umsgInfo(){
		$this->assign('info',M('umsg')->find(intval($_GET['id'])));
		$this->display($this->tpl);
	}


	public function vip(){
        $this->display($this->tpl);
    }

    public function category(){
        $this->display($this->tpl);
    }
	
	
	//推广二维码
	public function qrcode(){
		$this->assign('img',$this->getQrcode());
		$this->display($this->tpl);
	}
	
	public function getQrcode(){
		include COMMON_PATH.'Util/phpqrcode/phpqrcode.php';
		// 忽略用户取消，限制执行时间为90s
		ignore_user_abort();
		set_time_limit(90);
		//获取推广码信息
		$path_info = get_user_qrcode($this -> user['id']);
		// 目录不存在则创建
		if(!is_dir($path_info['path'])){
			mkdir($path_info['path'], 0777,1);
		}
		if(!is_file($path_info['qrcode'])){
			$uid = encode($this->user['id']);
			$url = "http://".$_SERVER['HTTP_HOST'].__ROOT__."/index.php?m=&c=Index&a=index&shareUser=".$uid;
			$errorCorrectionLevel = 'L';
			$matrixPointSize = 6;
			\QRcode::png($url, $path_info['qrcode'], $errorCorrectionLevel, $matrixPointSize, 2);	
		}

		//合成背景文字和头像
		$bj = $this->_site['sharepic'];
		$QR = $path_info['qrcode'];
		if($bj !== FALSE)
		{					
			$QR = imagecreatefromstring(file_get_contents($QR));
			$logo = imagecreatefromstring(file_get_contents($bj));

			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			// 合成二维码
			imagecopyresampled($logo , $QR , 350, 1070, 0, 0, $QR_width*1.65,$QR_height*1.65, $QR_width, $QR_height);
			imagejpeg($logo, $path_info['new']);
			imagedestroy($logo);
			imagedestroy($QR);
		}
		return $path_info['new'];
	}
	
	//新的签到
	public function sign(){
		$date = date('Ymd');
		$sign = M('sign')->where(array('date'=>$date,'user_id'=>$this->user['id']))->find();
		$signok=2;
		if($sign){
		  $signok=1;
		}
		//$signmoney=explode(',',$this->_site['signmoney']);
		$signmoney=$this->_site['signmoney'];
		$this->assign("signmoney",$signmoney);
	
		$this->assign("signok",signok);	
		$this->display($this->tpl);
	}
	
	//新定制加盟
	public function joinUs2(){
		$this->display($this->tpl);
	}
	public function kefu (){
		//dump($this->_site);
		$this->assign("site",$this->_site);	
		$this->display($this->tpl);
	}
	
	
	//目录
	public function mInfo(){
		$anid = I('get.anid');
		$where['anid'] = $anid;
		$list = show_list("anime_chapter",$where,'chaps asc');
		$this->assign('page',$list['page']);
		$this->assign("anime",M('anime')->find(intval($anid)));
		$this->assign("list",$list['list']);
		$this->display($this->tpl);
	}
}?>