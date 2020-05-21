<?php
namespace Mch\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function _initialize(){
		parent::_initialize();
		//初始化统计数据
		$this->_census();
	}
   
	public function index(){
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
		$where['mch'] = $this->mch['id'];
		
		
		//今日充值
		$this->assign('dcharge',M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$this->mch['id'],'separate'=>1))->sum('money'));
		//本月充值
		$this->assign('ycharge',M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'status'=>2,'mch'=>$this->mch['id'],'separate'=>1))->sum('money'));
		//累计充值
		$acharge = M('charge')->where(array('status'=>2,'mch'=>$this->mch['id'],'separate'=>1))->sum('money');
		$this->assign('acharge',$acharge);
		//已提现金额
		$this->assign('ymoney',M('withdraw')->where(array('status'=>2,'mch'=>$this->mch['id']))->sum('money'));
		//未结算金额
		$this->assign('wmoney',M('withdraw')->where(array('status'=>1,'mch'=>$this->mch['id']))->sum('money'));
		
		//累计成本
		$cben = M('chapter')->where(array('mch'=>$this->mch['id']))->sum('cost');
		$this->assign('cben',$cben);
		
		//累计利润
		$this->assign('lirun',$acharge-$cben);
		
		$this -> _list('data',$where,'id desc');
	}
	
	//统计昨日数据
	private function _census(){
		//定义初始开始统计日期
		$date = date('Ymd',$this->mch['create_time']);
		$mch = $this->mch['id']?$this->mch['id']:0;
		if(M('data')->where(array('date'=>$date,'mch'=>$mch))->find()){
			//昨天的日期
			$date = date('Ymd', strtotime('-1 day'));
			$info = M('data') -> where(array('date'=>$date,'mch'=>$mch)) -> find();
			// 如果有昨天的记录则结束
			if($info){
				return;
			}else{
				//查询统计的截止时间
				$last = M('data')->where(array('mch'=>$mch))->order('date desc')->find();
				$start = strtotime($last['date']);
				$start = $start +86400;
				$today = strtotime('today');
				$endtime = $today - 86400;
				for($start;$start<=$endtime;$start+=86400){
					$date = date('Ymd',$start);
					$stime = $start;
					$etime = $start+86400;
					
					//当日总充值金额
					$charge_total = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1))->sum('money');
					
					//当日普通充值金额
					$pcharge = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
					//当日普通充值人数
					$pchargeperson = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($stime, $etime)),'mch'=>$mch,'separate'=>1,'status'=>2,'isyear'=>0,'isover'=>0))->select();
					//当日普通充值笔数
					$pchargenums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
					//当日普通未支付笔数
					$pchargewnums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>1,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
					
					//当日年费充值金额
					$ycharge = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
					//当日年费充值人数
					$ychargeperson = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($stime, $etime)),'mch'=>$mch,'separate'=>1,'status'=>2,'isyear'=>1,'isover'=>0))->select();
					//当日年费充值笔数
					$ychargenums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
					//当日年费未支付笔数
					$ychargewnums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>1,'mch'=>$mch,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
					
					//当日终生充值金额
					$zcharge = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
					//当日终生充值人数
					$zchargeperson = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($stime, $etime)),'mch'=>$mch,'separate'=>1,'status'=>2,'isyear'=>0,'isover'=>1))->select();
					//当日终生充值笔数
					$zchargenums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
					//当日终生未支付笔数
					$zchargewnums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>1,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>1))->count();

					//付费人数
					$nums = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch))->select();
					$payperson = count($nums);
					//付费笔数
					$paynums = M('charge')->where(array('create_time'=>array('between', array($stime, $etime)),'status'=>2,'mch'=>$mch,'separate'=>1))->count();
					//新增用户数
					$joinperson = M('user')->where(array('join_time'=>array('between', array($stime, $etime)),'mch'=>$mch))->count();
					//新增关注人数
					$subperson = M('user')->where(array('join_time'=>array('between', array($stime, $etime)),'subscribe'=>1,'mch'=>$mch))->count();
					//新用户付费率
					$joinpersonpay = sprintf('%0.2f',$payperson/$joinperson*100);
					//新用户充值金额
					$joinpersoncharge = M('user')->where(array('join_time'=>array('between', array($stime, $etime)),'mch'=>$mch))->sum('charge_total');
					//累计所有用户
					$allusers = M('user')->where(array('join_time'=>array('elt', $etime),'mch'=>$mch))->count();
					//累计所有关注用户
					$allsubusers = M('user')->where(array('join_time'=>array('elt', $etime),'subscribe'=>1,'mch'=>$mch))->count();
					//新增男性人数
					$sexaperson = M('user')->where(array('join_time'=>array('between', array($stime, $etime)),'sex'=>1,'mch'=>$mch))->count();
					//新增女性人数
					$sexvperson = M('user')->where(array('join_time'=>array('between', array($stime, $etime)),'sex'=>2,'mch'=>$mch))->count();
					M('data')->add(array(
						"date"=>$date,
						"mch"=>$mch,
						"charge_total"=>$charge_total?$charge_total:0,
						
						"pcharge"=>$pcharge?$pcharge:0,
						"pchargeperson"=>count($pchargeperson),
						"pchargenums"=>$pchargenums?$pchargenums:0,
						"pchargewnums"=>$pchargewnums?$pchargewnums:0,
						
						"ycharge"=>$ycharge?$ycharge:0,
						"ychargeperson"=>count($ychargeperson),
						"ychargenums"=>$ychargenums?$ychargenums:0,
						"ychargewnums"=>$ychargewnums?$ychargewnums:0,
						
						"zcharge"=>$zcharge?$zcharge:0,
						"zchargeperson"=>count($zchargeperson),
						"zchargenums"=>$zchargenums?$zchargenums:0,
						"zchargewnums"=>$zchargewnums?$zchargewnums:0,
						
						"payperson"=>$payperson,
						"paynums"=>$paynums,
						"joinperson"=>$joinperson,
						"subperson"=>$subperson,
						"joinpersonpay"=>$joinpersonpay,
						"joinpersoncharge"=>$joinpersoncharge,
						"allusers"=>$allusers,
						"allsubusers"=>$allsubusers,
						"sexaperson"=>$sexaperson,
						"sexvperson"=>$sexvperson,
					));	
				}
			}
		}else{

			$stime = strtotime($date);
			$etime = strtotime('today');
			for($stime;$stime<$etime;$stime+=86400){
				$date = date('Ymd', $stime);
				$start = $stime;
				$end = $stime+86400;
				//总充值金额
				$charge_total = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1))->sum('money');
				
				//当日普通充值金额
				$pcharge = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
				//当日普通充值人数
				$pchargeperson = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($start, $end)),'mch'=>$mch,'separate'=>1,'status'=>2,'isyear'=>0,'isover'=>0))->select();
				//当日普通充值笔数
				$pchargenums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
				//当日普通未支付笔数
				$pchargewnums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>1,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
				
				//当日年费充值金额
				$ycharge = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
				//当日年费充值人数
				$ychargeperson = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($start, $end)),'mch'=>$mch,'separate'=>1,'status'=>2,'isyear'=>1,'isover'=>0))->select();
				//当日年费充值笔数
				$ychargenums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
				//当日年费未支付笔数
				$ychargewnums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>1,'mch'=>$mch,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
				
				//当日终生充值金额
				$zcharge = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
				//当日终生充值人数
				$zchargeperson = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($start, $end)),'mch'=>$mch,'separate'=>1,'status'=>2,'isyear'=>0,'isover'=>1))->select();
				//当日终生充值笔数
				$zchargenums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
				//当日终生未支付笔数
				$zchargewnums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>1,'mch'=>$mch,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
				
				//付费人数
				$nums = M('charge')->distinct(true)->field('user_id')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch))->select();
				$payperson = count($nums);
				//付费笔数
				$paynums = M('charge')->where(array('create_time'=>array('between', array($start, $end)),'status'=>2,'mch'=>$mch,'separate'=>1))->count();
				//新增用户数
				$joinperson = M('user')->where(array('join_time'=>array('between', array($start, $end)),'mch'=>$mch))->count();
				//新增关注人数
				$subperson = M('user')->where(array('join_time'=>array('between', array($start, $end)),'subscribe'=>1,'mch'=>$mch))->count();
				//新用户付费率
				$joinpersonpay = sprintf('%0.2f',$payperson/$joinperson*100);
				//新用户充值金额
				$joinpersoncharge = M('user')->where(array('join_time'=>array('between', array($start, $end)),'mch'=>$mch))->sum('charge_total');
				//累计所有用户
				$allusers = M('user')->where(array('join_time'=>array('elt', $end),'mch'=>$mch))->count();
				//累计所有关注用户
				$allsubusers = M('user')->where(array('join_time'=>array('elt', $end),'subscribe'=>1,'mch'=>$mch))->count();
				//新增男性人数
				$sexaperson = M('user')->where(array('join_time'=>array('between', array($start, $end)),'sex'=>1,'mch'=>$mch))->count();
				//新增女性人数
				$sexvperson = M('user')->where(array('join_time'=>array('between', array($start, $end)),'sex'=>2,'mch'=>$mch))->count();
				M('data')->add(array(
					"date"=>$date,
					"mch"=>$mch,
					"charge_total"=>$charge_total?$charge_total:0,
					
					"pcharge"=>$pcharge?$pcharge:0,
					"pchargeperson"=>count($pchargeperson),
					"pchargenums"=>$pchargenums?$pchargenums:0,
					"pchargewnums"=>$pchargewnums?$pchargewnums:0,
					
					"ycharge"=>$ycharge?$ycharge:0,
					"ychargeperson"=>count($ychargeperson),
					"ychargenums"=>$ychargenums?$ychargenums:0,
					"ychargewnums"=>$ychargewnums?$ychargewnums:0,
					
					"zcharge"=>$zcharge?$zcharge:0,
					"zchargeperson"=>count($zchargeperson),
					"zchargenums"=>$zchargenums?$zchargenums:0,
					"zchargewnums"=>$zchargewnums?$zchargewnums:0,
					
					"payperson"=>$payperson,
					"paynums"=>$paynums,
					"joinperson"=>$joinperson,
					"subperson"=>$subperson,
					"joinpersonpay"=>$joinpersonpay,
					"joinpersoncharge"=>$joinpersoncharge,
					"allusers"=>$allusers,
					"allsubusers"=>$allsubusers,
					"sexaperson"=>$sexaperson,
					"sexvperson"=>$sexvperson,
				));
			}
		}
	}

	
	//公众号信息
	public function mp(){
		$_GET['id'] = $this->mch['id'];
		$this->_edit('mch',U('mp'));
	}
	
	
	//通用删除AJAX
	public function delTableByid(){
		if(IS_POST){
			$table = I('post.table');
			$id = I('post.id');
			if($table =="autoreply"){
				M($table)->where(array('id'=>$id))->delete();
				M('news')->where(array('aid'=>$id))->delete();
			}elseif($table == "chapter"){
				M($table)->where(array('id'=>$id))->save(array('status'=>0,'update_time'=>time()));
			}else{
				M($table)->where(array('id'=>$id))->delete();
			}
			$this->success('删除成功！');
		}else{
			$this->error('非法请求！');
		}
	}
	
	// 上传图片
	public function upload(){
		if(!empty($_GET['url']))
			$this -> assign('url', $_GET['url']);
		if(IS_POST){
			
			if($_GET['field'])
				$field = $_GET['field'];
			if(empty($field))
				$field = 'file';
			
			if($_FILES[$field]['size'] < 1 && $_FILES[$field]['size']>0){
				$this -> assign('errmsg', '上传错误！');
			}else{
				$ext = $this -> _get_ext($_FILES[$field]['name']);
				$new_name = $this -> _get_new_name($ext, 'images');
				if(move_uploaded_file($_FILES[$field]['tmp_name'], $new_name['fullname'])){
					$this -> assign('url', $new_name['fullname']);
				}else
					$this -> assign('errmsg', '文件保存错误！');
				
				
			}
		}
		C('LAYOUT_ON', false);
		$this -> display();
	}
	
	/**
	*	根据文件名获取后缀
	*/
	private function _get_ext($file_name){
        return substr(strtolower(strrchr($file_name, '.')),1);
    }

    /**
	*	根据文件类型(后缀)生成文件名和路径
	*	@param return array('name', 'fullname' )
	*	* 文件名取时间戳和随机数的36进制而不是62进制是为了防止windows下大小写不敏感导致文件重名
	*/
	private function _get_new_name($ext, $dir = 'default'){
        $name 		= date('His') . substr(microtime(),2,8) . rand(1000,9999) . '.' . $ext;
        $path 		= './Public/upload/' . $dir . date('/ym/d') .'/';

        // 如果路径不存在则递归创建
        if(!is_dir($path)){
        	mkdir($path, 0777, 1);
        }

        return array(
        		'name'		=> $name,
        		'fullname'	=> $path . $name
        	);
    }
}