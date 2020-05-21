<?php


// 对字符串进行加盐散列加密
function xmd5($str){
	return md5(md5($str).C('SAFE_SALT'));
}

// 获得当前的url
function get_current_url(){
	$url = "http://" . $_SERVER['HTTP_HOST'];
	$url .= $_SERVER['REQUEST_URI'];
	return $url;
}

// 补全url
function complete_url($url){
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	if(substr($url,0,1) == '.'){
		return $protocol . $_SERVER['HTTP_HOST'].__ROOT__.substr($url,1);
	}
	elseif(substr($url,0,7) != 'http://' && substr($url,0,8) != 'https://'){
		return $protocol . $_SERVER['HTTP_HOST'].$url;
	}
	else{
		return $url;
	}
	
}

function getRandCode(){
	$str = time() . rand(1,1000000);
	$str = md5($str);
	$str = str_pad($str, 5, '0', STR_PAD_LEFT);
	$str = substr($str,8,8);
	return $str;
}


//漫画小说属性字典
function getZd($field,$val){
	
	$arr = array(
		"iswz"=>array(
			"1"=>"连载中",
			"2"=>"已完结",
		),
		"isfw"=>array(
			"1"=>"小图",
			"2"=>"大图",
		),
		"isnew"=>array(
			"1"=>"新书",
			"2"=>"非新书",
		),
		"islong"=>array(
			"1"=>"长篇",
			"2"=>"短篇",
		),
		"issex"=>array(
			"1"=>"男频",
			"2"=>"女频",
		),
	);
	return $arr[$field][$val];
}


//获得财务记录动作名称
function get_finance_action($action){
	$return = '';
	switch($action){
		case 1: $return = '在线充值';break;
		case 2: $return = '签到赠送';break;
		case 3: $return = '在线阅读';break;
		case 4: $return = '客服充值';break;
		case 5: $return = '分享小说漫画赠送';break;
		case 6: $return = '观看视频';break;
		case 7: $return = '购买名家经典';break;
		case 8: $return = '分享名家经典赠送';break;
		case 9: $return = '活动充值';break;
		case 10: $return = '打赏分成';break;
		default : $return = '未知操作';
	}
	return $return;
}

/** 添加财务日志
*	type => money:余额记录,points:积分记录
*/
function flog($user_id, $type, $money, $action,$anid=0,$chaps=0){
	M('finance') -> add(array(
		'user_id' => $user_id,
		'anid'=>$anid,
		'chaps'=>$chaps,
		'type' => $type,
		'value' => $money,
		'action' => $action,
		'create_time' => NOW_TIME
	));
}


// 根据自定义菜单类型返回名称
function get_selfmenu_type($type){
	$type_name = '';
	switch($type){
		case 'click':
			$type_name = '点击推事件';
			break;
		case 'view':
			$type_name = '跳转URL';
			break;
		case 'scancode_push':
			$type_name = '扫码推事件';
			break;
		case 'scancode_waitmsg':
			$type_name = '扫码推事件且弹出“消息接收中”提示框';
			break;
		case 'pic_sysphoto':
			$type_name = '弹出系统拍照发图';
			break;
		case 'pic_photo_or_album':
			$type_name = '弹出拍照或者相册发图';
			break;
		case 'pic_weixin':
			$type_name = '弹出微信相册发图器';
			break;
		case 'location_select':
			$type_name = '弹出地理位置选择器';
			break;
		default : $type_name = '不支持的类型';
	}
	return $type_name;
}


// 获得一个标的列表
function show_list($table, $where = null, $order = "id desc", $pagesize = 20 , $handler = null){
	$count = M($table) -> where($where) -> count();
	$page = new \Think\Page($count, $pagesize);
	$list = M($table) -> where($where) -> limit($page -> limit()) -> order($order) -> select();
	//echo M()->getLastSql();
	if($handler && !empty($list)){
		foreach($list as &$item){
			$item = $handler($item);
		}
	}
	return array(
		'list'	=> $list,
		'page'	=> $page -> show(),
		'count' => $count,
		'total_pages' => $page -> total_pages()
	);
}



// 发送客服提示消息
function send_msg($mp,$openid,$data,$type="text"){
	$dd = new \Common\Util\ddwechat();
	$dd -> setParam($mp);
	if($type == "image"){
		$msg = array(
			'touser' => $openid,
			'msgtype' => 'image',
			'image' => array(
				'media_id' => $data
			)
		);
	}elseif($type == "text"){
		$msg = array(
			'touser' => $openid,
			'msgtype' => 'text',
			'text' => array(
				'content' => $data
			)
		);
	}elseif($type == "news"){
		$msg = array(
			'touser' => $openid,
			'msgtype' => 'news',
			'news' => array('articles'=>$data),
		);
	}
	file_put_contents('a.txt',var_export($msg,1),FILE_APPEND);
	return $dd -> custommsg($msg);
}



// 获得代理生成推广链接二维码信息
function get_qrcode_path($mch,$anid,$chaps,$k=0){
	$path = './Public/qrcode/'.$mch.'/'.$anid.'/'.$chaps.'/';
	return array(
		'path'		=> $path,
		'new'		=> $path.$k.'_pic.jpg',
		'qrcode'	=> $path.'qrcode.jpg',
		
	);
}

function get_user_qrcode($user){
	$path = './Public/qrcode/'.date('Ymd').'/';
	return array(
		'path'		=> $path,
		'new'		=> $path.$user.'_pic.jpg',
		'qrcode'	=> $path.$user.'qrcode.jpg',
		
	);
}



/**
 * 二维数组根据字段进行排序
 * @params array $array 需要排序的数组
 * @params string $field 排序的字段
 * @params string $sort 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
 */
function arraySequence($array, $field, $sort = 'SORT_DESC'){
    $arrSort = array();
    foreach ($array as $uniqid => $row) {
        foreach ($row as $key => $value) {
            $arrSort[$key][$uniqid] = $value;
        }
    }
    array_multisort($arrSort[$field], constant($sort), $array);
    return $array;
}


/**
 * 对称加密算法之加密
 */
function encode($string = '', $skey = 'Lswig') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

/**
 * 对称加密算法之解密
 */
function decode($string = '', $skey = 'Lswig') {
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
}

//创建新浪短链接
/**
 * 调用新浪接口将长链接转为短链接
 * @param  string        $source    申请应用的AppKey
 * @param  array|string  $url_long  长链接，支持多个转换（需要先执行urlencode)
 * @return array
 */
function getSinaShortUrl($url_long){
	$source = "2823037850";
	
    // 参数检查
    if(empty($source) || !$url_long){
        return false;
    }

    // 参数处理，字符串转为数组
    if(!is_array($url_long)){
        $url_long = array($url_long);
    }

    // 拼接url_long参数请求格式
    $url_param = array_map(function($value){
        return '&url_long='.urlencode($value);
    }, $url_long);

    $url_param = implode('', $url_param); 

    // 新浪生成短链接接口
    $api = 'http://api.t.sina.com.cn/short_url/shorten.json';

    // 请求url
    $request_url = sprintf($api.'?source=%s%s', $source, $url_param);

    $result = array();

    // 执行请求
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $request_url);
    $data = curl_exec($ch);
    if($error=curl_errno($ch)){
        return false;
    }
    curl_close($ch);

    $result = json_decode($data, true);

    return $result[0]['url_short'];

}


//将URL中的某参数设为某值
function url_set_value($url,$key,$value) { 
	$a=explode('?',$url); 
	$url_f=$a[0]; 
	$query=$a[1]; 
	parse_str($query,$arr); 
	$arr[$key]=$value; 
	return $url_f.'?'.http_build_query($arr); 
}

//curl post 请求
function http($url,$data,$method="POST"){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$tmpInfo = curl_exec($ch);
	$errorno = curl_errno($ch);
	if(!$errorno)return $tmpInfo;
	else{
		$this->errmsg = $errorno;
		return false;
	}
}


//判断是否微信打开
 function is_weixin() { 
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) { 
        return true; 
    } return false; 
}

function str_rand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    if(!is_int($length) || $length < 0) {
        return false;
    }
    $string = '';
    for($i = $length; $i > 0; $i--) {
        $string .= $char[mt_rand(0, strlen($char) - 1)];
    }
    return strtolower($string);
}



    