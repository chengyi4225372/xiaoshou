<?php
namespace Mch\Controller;
use Think\Controller;
class NoticeController extends CommonController {
   
	public function index(){
		$this -> _list('notice',$where,'create_time desc');
	}
	
	
}