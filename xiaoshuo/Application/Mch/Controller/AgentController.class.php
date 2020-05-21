<?php
namespace Mch\Controller;
use Think\Controller;
class AgentController extends CommonController {
   
	public function index(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['status'])){
			$where['status'] = $_GET['status'];
		}
		if(!empty($_GET['keyword'])){
			$where['title|mobile'] = array('like','%'.$_GET['keyword'].'%');
		}
		$where['type'] = 1;
		$where['parent1'] = $this->mch['id'];
		$this->_list("mch",$where,'id desc');
	}
	
	public function indes(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['status'])){
			$where['status'] = $_GET['status'];
		}
		if(!empty($_GET['keyword'])){
			$where['title|mobile'] = array('like','%'.$_GET['keyword'].'%');
		}
		$where['type'] = 2;
		$where['parent1'] = $this->mch['id'];
		$this->_list("mch",$where,'id desc');
	}
	
	
	//修改增加服务号资料
	public function edit(){
		if(IS_POST){			
			if(isset($_POST['id']) && $_POST['id']>0){
				$_POST['tpass'] = $_POST['pass'];
				$_POST['pass'] = xmd5($_POST['pass']);
				$_POST['topnums'] = $this->mch['topnums'] + 1;
				if($_POST['lv']>=$this->mch['lv']){
					$this->error('佣金比例不能超过自身的比例');
				}
				M('mch')->where(array('id'=>$_POST['id']))->save($_POST);
				$this->success('修改成功！',U('index'));
			}else{
				$_POST['parent1'] = $this->mch['id'];
				$_POST['parent2'] = $this->mch['parent1'];
				$_POST['parent3'] = $this->mch['parent2'];
				$_POST['create_time'] = time();
				$_POST['tpass'] = $_POST['pass'];
				$_POST['pass'] = xmd5($_POST['pass']);
				$_POST['status'] = 1;
				$_POST['topnums'] = $this->mch['topnums'] + 1;
				if(M('mch')->where(array('username'=>$_POST['username']))->find()){
					$this->error('代理账号已经存在！');
				}
				if($_POST['lv']>=$this->mch['lv']){
					$this->error('佣金比例不能超过自身的比例');
				}
				M('mch')->add($_POST);
				$this->success('添加成功！',U('index'));
			}
		}
		if($_GET['id']>0){
			$this->assign('info',M('mch')->find(intval($_GET['id'])));
		}
		$this->display();
	}
	
	//修改增加订阅号资料
	public function edit2(){
		if(IS_POST){			
			if(isset($_POST['id']) && $_POST['id']>0){
				$_POST['tpass'] = $_POST['pass'];
				$_POST['pass'] = xmd5($_POST['pass']);
				$_POST['topnums'] = $this->mch['topnums'] + 1;
				if($_POST['lv']>=$this->mch['lv']){
					$this->error('佣金比例不能超过自身的比例');
				}
				M('mch')->where(array('id'=>$_POST['id']))->save($_POST);
				$this->success('修改成功！',U('indes'));
			}else{
				$_POST['parent1'] = $this->mch['id'];
				$_POST['parent2'] = $this->mch['parent1'];
				$_POST['parent3'] = $this->mch['parent2'];
				$_POST['create_time'] = time();
				$_POST['tpass'] = $_POST['pass'];
				$_POST['pass'] = xmd5($_POST['pass']);
					$_POST['status'] = 1;
				$_POST['topnums'] = $this->mch['topnums'] + 1;
				if(M('mch')->where(array('username'=>$_POST['username']))->find()){
					$this->error('代理账号已经存在！');
				}
				if($_POST['lv']>=$this->mch['lv']){
					$this->error('佣金比例不能超过自身的比例');
				}
				$id = M('mch')->add($_POST);
				$url = "http://".$this->mch['url']."/index.php?mch=".encode($id);
				M('mch')->where(array('id'=>$id))->save(array('url'=>$url));
				$this->success('添加成功！',U('indes'));
			}
		}
		if($_GET['id']>0){
			$this->assign('info',M('mch')->find(intval($_GET['id'])));
		}
		$this->display();
	}
	
	
	//设置密码和禁用启用
	public function setStatus(){
		if(IS_POST){
			$id = I('post.id');
			$mch = M('mch')->find(intval($id));
			$status = $mch['status'] == 1?-1:1;
			M('mch')->where(array('id'=>$id))->save(array('status'=>$status));
			$this->ajaxReturn(array('status'=>1,'info'=>'操作成功！','update'=>$status));
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//用户数据
	public function users(){
		$id = I('get.id');
		
		//今日用户数
		$tuser['all'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-d'))),'mch'=>$tid))->count();
		//今日男性用户
		$tuser['nuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-d'))),'mch'=>$id,'sex'=>1))->count();
		//今日女性用户
		$tuser['vuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-d'))),'mch'=>$id,'sex'=>2))->count();
		//今日未知性别用户
		$tuser['wuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-d'))),'mch'=>$id,'sex'=>array('not in','1,2')))->count();
		//今日已关注用户
		$tuser['subuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-d'))),'mch'=>$id,'subscribe'=>1))->count();
		//今日付费用户
		$tuser['payuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-d'))),'mch'=>$id,'charge_total'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('tuser',$tuser);
		
		/**今日统计结束**/
		
		$etime = strtotime('today');
		$stime = $etime - 86400;
		//昨日用户数
		$yuser['all'] = M('user')->where(array('join_time'=>array(array('egt',$stime),array('elt',$etime)),'mch'=>$id))->count();

		//昨日男性用户
		$yuser['nuser'] = M('user')->where(array('join_time'=>array(array('egt',$stime),array('elt',$etime)),'mch'=>$id,'sex'=>1))->count();
		//昨日女性用户
		$yuser['vuser'] = M('user')->where(array('join_time'=>array(array('egt',$stime),array('elt',$etime)),'mch'=>$id,'sex'=>2))->count();
		//昨日未知性别用户
		$yuser['wuser'] = M('user')->where(array('join_time'=>array(array('egt',$stime),array('elt',$etime)),'mch'=>$id,'sex'=>array('not in','1,2')))->count();
		//昨日已关注用户
		$yuser['subuser'] = M('user')->where(array('join_time'=>array(array('egt',$stime),array('elt',$etime)),'mch'=>$id,'subscribe'=>1))->count();
		//昨日付费用户
		$yuser['payuser'] = M('user')->where(array('join_time'=>array(array('egt',$stime),array('elt',$etime)),'mch'=>$id,'charge_total'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('yuser',$yuser);
		
		/**昨日统计结束**/
		
		//本月用户数
		$muser['all'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-01'))),'mch'=>$id))->count();
		//本月男性用户
		$muser['nuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-01'))),'mch'=>$id,'sex'=>1))->count();
		//本月女性用户
		$muser['vuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-01'))),'mch'=>$id,'sex'=>2))->count();
		//本月未知性别用户
		$muser['wuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-01'))),'mch'=>$id,'sex'=>array('not in','1,2')))->count();
		//本月已关注用户
		$muser['subuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-01'))),'mch'=>$id,'subscribe'=>1))->count();
		//本月付费用户
		$muser['payuser'] = M('user')->where(array('join_time'=>array('egt',strtotime(date('Y-m-01'))),'mch'=>$id,'charge_total'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('muser',$muser);
		
		/**本月统计结束**/
		
		//所有用户数
		$auser['all'] = M('user')->where(array('mch'=>$id))->count();
		//所有男性用户
		$auser['nuser'] = M('user')->where(array('mch'=>$id,'sex'=>1))->count();
		//所有女性用户
		$auser['vuser'] = M('user')->where(array('mch'=>$id,'sex'=>2))->count();
		//所有未知性别用户
		$auser['wuser'] = M('user')->where(array('mch'=>$id,'sex'=>array('not in','1,2')))->count();
		//所有已关注用户
		$auser['subuser'] = M('user')->where(array('mch'=>$id,'subscribe'=>1))->count();
		//所有付费用户
		$auser['payuser'] = M('user')->where(array('mch'=>$id,'charge_total'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('auser',$auser);
		
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		$time1 = str_replace("-","",$_GET['time1']);
		$time2 = str_replace("-","",$_GET['time2']);
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['date'] = array(
				array('egt', $time1),
				array('elt', $time2)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['date'] = array('egt', $time1);
		}
		elseif(!empty($_GET['time2'])){
			$where['date'] = array('elt', $time2);
		}
		
		$where['mch'] = $id;
		$this -> _list('data',$where,'id desc');
	}
	
	
	//订单统计
	public function orders(){
		$id = I('get.id');
		
		//今日充值总额
		$tcharge['total'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1))->sum('money');
		
		//今日普通充值总额
		$tcharge['ptotal'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
		//今日普通充值支付笔数
		$tcharge['pnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		//今日普通充值未支付笔数
		$tcharge['pwnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		
		//今日年费充值总额
		$tcharge['ytotal'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
		//今日年费充值支付笔数
		$tcharge['ynums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		//今日年费充值未支付笔数
		$tcharge['ywnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		
		//今日终生充值总额
		$tcharge['ztotal'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
		//今日终生充值支付笔数
		$tcharge['znums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		//今日终生充值未支付笔数
		$tcharge['zwnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		
		$this->assign('tcharge',$tcharge);
		
		//今日充值结束
		
		//昨日充值，直接调用统计的数据
		$yesdate = date("Ymd",strtotime("-1 day"));
		$this->assign('yescharge',M('data')->where(array('mch'=>$id,'date'=>$yesdate))->find());
		
		
		//本月充值总额
		
		$stime = strtotime(date('Y-m-01'));
		$etime = strtotime(date('Y-m-d'));
		
		$mcharge['total'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1))->sum('money');
		
		//本月普通充值总额
		$mcharge['ptotal'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
		
		//本月普通充值支付笔数
		$mcharge['pnums'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		//今日普通充值未支付笔数
		$mcharge['pwnums'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		
		//本月年费充值总额
		$mcharge['ytotal'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
		//本月年费充值支付笔数
		$mcharge['ynums'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		//今日年费充值未支付笔数
		$mcharge['ywnums'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		
		//本月终生充值总额
		$mcharge['ztotal'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
		//本月终生充值支付笔数
		$mcharge['znums'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		//本月终生充值未支付笔数
		$mcharge['zwnums'] = M('charge')->where(array('create_time'=>array( array('egt',$stime),array('elt',$etime)),'status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		
		$this->assign('mcharge',$mcharge);
		
		
		//累计充值
		
		//累计充值总额
		$acharge['total'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1))->sum('money');
		
		//累计普通充值总额
		$acharge['ptotal'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
		//累计普通充值支付笔数
		$acharge['pnums'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		//累计普通充值未支付笔数
		$acharge['pwnums'] = M('charge')->where(array('status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		
		//累计年费充值总额
		$acharge['ytotal'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
		//累计年费充值支付笔数
		$acharge['ynums'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		//累计年费充值未支付笔数
		$acharge['ywnums'] = M('charge')->where(array('status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		
		//累计终生充值总额
		$acharge['ztotal'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
		//累计终生充值支付笔数
		$acharge['znums'] = M('charge')->where(array('status'=>2,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		//累计终生充值未支付笔数
		$acharge['zwnums'] = M('charge')->where(array('status'=>1,'mch'=>$id,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		
		$this->assign('acharge',$acharge);
		
		//今日充值结束
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		$time1 = str_replace("-","",$_GET['time1']);
		$time2 = str_replace("-","",$_GET['time2']);
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['date'] = array(
				array('egt', $time1),
				array('elt', $time2)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['date'] = array('egt', $time1);
		}
		elseif(!empty($_GET['time2'])){
			$where['date'] = array('elt', $time2);
		}
		
		$where['mch'] = $id;
		
		$this->_list('data',$where,'date desc');
	}
	
	
	//财务/订单
	public function corder(){
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['name'])){
			$where['sn|atitle'] = array('like','%'.$_GET['name'].'%');
		}
		
		if(!empty($_GET['status'])){
			$where['status'] = intval($_GET['status']);
		}
		$where['separate'] = 1;
		
		$sons = M('mch')->where(array('parent1'=>$this->mch['id']))->getField('id',true);
		if($sons){
			$where['mch'] = array('in',implode(",",$sons));
			$list = $this->_get_list('charge',$where,'create_time desc');
		

			foreach($list as $k=>$v){
				$list[$k]['user'] = M('user')->where(array('id'=>$v['user_id']))->find();
				$list[$k]['vcount'] = M('charge')->where(array('user_id'=>$v['user_id'],'id'=>array('elt',$v['id'])))->count();
				$list[$k]['mchname'] = M('mch')->where(array('id'=>$v['mch']))->getField('name');
			}
		}
		
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
}