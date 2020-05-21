<?php
namespace Mch\Controller;
use Think\Controller;
class ExportController extends CommonController {
   
	//导出每日汇总
	public function exportIndex(){
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
		
		$list = M('data') -> where($where)->order('id desc') -> select();
		
		// 表头
		$data[0] = array(
			'日期',
			'充值金额',
			'付费人数',
			'付费笔数',
			'新增用户',
			'新用户关注',
			'新用户付费率',
			'新用户充值金额',
			'累计用户数',
			'累计粉丝',
		);
		foreach($list as $v){
			$lv = sprintf("%0.2f",$v['payperson']/$v['joinperson'])*100;
			$data[] = array(
				$v['date'],
				$v['charge_total'],
				$v['payperson'],
				$v['paynums'],
				$v['joinperson'],
				$v['subperson'],
				$lv.'%',
				$v['joinpersoncharge'],
				$v['allusers'],
				$v['allsubusers'],
			);
		}
		
		$filename = NOW_TIME.".csv";
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Type: application/download"); 
		header('Content-Disposition:inline;filename="'.$filename.'"'); 
		header("Content-Transfer-Encoding: binary"); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Pragma: no-cache"); 
		
		foreach($data as $d){
			echo implode(',',$d);
			echo "\r\n";
		}
		
		die();
	}
	
	
	//导出用户数据
	public function exportUsers(){
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
		$list = M('data') -> where($where)->order('id desc') -> select();
		
		// 表头
		$data[0] = array(
			'日期',
			'新增用户',
			'已关注',
			'已付费',
			'男性',
			'女性',
		);
		foreach($list as $v){
			$data[] = array(
				$v['date'],
				$v['joinperson'],
				$v['subperson'],
				ceil($v['joinpersonpay']*$v['joinperson']/100),
				$v['sexaperson'],
				$v['sexvperson'],
			);
		}
		
		$filename = NOW_TIME.".csv";
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Type: application/download"); 
		header('Content-Disposition:inline;filename="'.$filename.'"'); 
		header("Content-Transfer-Encoding: binary"); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Pragma: no-cache"); 
		
		foreach($data as $d){
			echo implode(',',$d);
			echo "\r\n";
		}
		
		die();
	}
	
	//导出外推
	public function exportChapter(){
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
		
		if(!empty($_GET['keyword'])){
			$where['name|msg|title'] = array('like', '%'.$_GET['keyword'].'%');
		}
		
		$where['mch'] = $this->mch['id'];
		$list = M('chapter') -> where($where)->order('id desc') -> select();
		
		// 表头
		$data[0] = array(
			'推广名称',
			'书名',
			'引导人数',
			'关注人数',
			'关注人数/比例',
			'充值金额/引导人数',
			'总充值',
			'成本',
			'利润',
			'回本率',
			'备注',
			'创建时间',
		);
		foreach($list as $v){
			if($v['charge']>0){
				$lv = sprintf("%.2f",$v['charge']/$v['cost'])*100;
				$lv = $lv.'%';
			}else{
				$lv = "0%";
			}
			$data[] = array(
				$v['name'],
				$v['title'],
				$v['pernums'],
				$v['subnums'],
				sprintf("%.2f",$v['subnums']/$v['pernums']*100),
				sprintf("%.2f",$v['charge']/$v['pernums']*100),
				$v['charge'],
				$v['cost'],
				$v['charge']-$v['cost'],
				$lv,
				$v['msg'],
				"\t".date('Y-m-d H:i:s',$v['create_time']),
			);
		}
		
		$filename = NOW_TIME.".csv";
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Type: application/download"); 
		header('Content-Disposition:inline;filename="'.$filename.'"'); 
		header("Content-Transfer-Encoding: binary"); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Pragma: no-cache"); 
		
		foreach($data as $d){
			echo implode(',',$d);
			echo "\r\n";
		}
		
		die();
	}
	
	//导出财务/订单
	public function exportCorders(){
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
		$where['mch'] = $this->mch['id'];
		$list = M('charge') -> where($where)->order('id desc') -> select();
		
		// 表头
		$data[0] = array(
			'订单号',
			'渠道来源',
			'订单类型',
			'用户昵称',
			'注册时间',
			'充值书籍',
			'金额（元）',
			'订单状态',
			'创建时间',
		);
		foreach($list as $v){
			if($v['isyear']){
				$type = "年费充值";
			}elseif($v['isover']){
				$type = "终生充值";
			}else{
				$type = "普通充值";
			}
			if($v['status'] == 1){
				$status = "未支付";
			}else{
				$status = "已支付";
			}
			$join_time = M('user')->where(array('id'=>$v['user_id']))->getField('join_time');
			$data[] = array(
				$v['sn'],
				$v['ctitle'],
				$type,
				$v['nickname'],
				"\t".date('Y-m-d H:i:s',$join_time),
				$v['atitle'],
				$v['money'],
				$status,
				"\t".date('Y-m-d H:i:s',$v['create_time']),
			);
		}
		
		$filename = NOW_TIME.".csv";
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Type: application/download"); 
		header('Content-Disposition:inline;filename="'.$filename.'"'); 
		header("Content-Transfer-Encoding: binary"); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Pragma: no-cache"); 
		
		foreach($data as $d){
			echo implode(',',$d);
			echo "\r\n";
		}
		
		die();
	}
}