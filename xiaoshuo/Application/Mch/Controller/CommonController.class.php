<?php
namespace Mch\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){

		if(!session('?mch')){
			redirect(U('Pub/login'));
		}

		$this->mch = M('mch')->find(intval(session("mch.id")));
		$this->assign('mch',$this->mch);
		
		// _开头的函数为内部函数，不能直接访问
		if(substr(ACTION_NAME,0,1) == '_'){
			$this -> error('访问地址错误！', U('Index/index'));
		}
		
		// 从数据读取配置参数
		$config = M('config') -> select();
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = json_decode($v['value'],1);
			$_CFG[$v['name']] = $this -> $key;
		}

		$this -> assign('_CFG', $_CFG);
		$GLOBALS['_CFG'] = $_CFG;

		$mp = array(
			"appid"=>$this->mch['appid'],
			"appsecret"=>$this->mch['appsecret'],
		);
		$this->_mp = $mp;
		
		//当前地址
		$CAname = "c=".CONTROLLER_NAME."&a=".ACTION_NAME;
		$this->assign("CAname",$CAname);
    }
	
	
	// 通用简单列表方法
	protected function _list($table, $where= null, $order = null){
		$list = $this -> _get_list($table, $where, $order);
		$this -> assign('list', $list);
		$this -> assign('page', $this -> data['page']);
		$this -> display();
	}
	
	// 获得一个列表,返回而不输出
	protected function _get_list($table, $where= null, $order = null){
		$model = M($table);
		$count = $model -> where($where) -> count();
		$page = new \Think\Page($count, 15);
		if(!$order){
			$order = "id desc";
		}
		$list = $model -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows ) -> order($order) -> select();
		//echo M()->getLastSql();
		// 将数据保存到成员变量
		$this -> data = array(
			'list' => $list,
			'page' => $page -> show(),
			'count' => $count
		);
		
		return $list;
	}
	
	// 通用编辑方法,根据POST自动增加或者修改
	protected function _edit($table, $url = null){
		$model = M($table);
		
		$id = intval($_GET['id']);
		if($id>0){
			$info = $model -> find($id);
			if(!$info)
				die('信息不存在');
			
			$this -> assign('info', $info);
		}
		if(IS_POST){
			if(!$url)
				$url = U('index');
			if($id>0){
				$_POST['id'] = $id;
				$model -> save($_POST);
				$this -> success('操作成功！', $url);
				exit;
			}else{
				$model -> add($_POST);
				$this -> success('添加成功！', $url);
				exit;
			}
		}
		
		$this -> display();
	}
	

	
}