<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE'    => 'Home', //默认模块
	'MODULE_ALLOW_LIST'	=> array('Home', 'Admin','Homee','Mch','Pay','Api'),
	'LOAD_EXT_CONFIG' 	=> 'db',
	'URL_MODEL'			=> 0,
	'DATA_CACHE_TYPE'	=> 'file',
	'DATA_CACHE_TIME'	=> 7000,
	'SAFE_SALT'			=> '/@DragonDean/#', // 全局盐值
	
	'LODGE'             => array(
		"seqing"=>"色情",
		"xuexing"=>"血腥",
		"baoli"=>"暴力",
		"weifa"=>"违法",
		"daoban"=>"盗版",
		"qita"=>"其他",
	),
	//文案制作章节title
	'GTITLES' 			=> array(
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body1.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body2.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body3.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body4.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body5.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body6.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body7.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body8.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body9.jpg",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/bodys/body10.jpg",
	),
	//文案制作阅读原文pics
	'YUEPICS' 			=> array(
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/readpic/pic1.png",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/readpic/pic2.png",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/readpic/pic3.png",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/readpic/pic4.gif",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/readpic/pic5.gif",
		"http://".$_SERVER['SERVER_NAME'].__ROOT__."/Public/admin/readpic/pic6.gif",
	),
	//文案制作二维码背景图
	'QPICS' 			=> array(
		"./Public/qpics/qrcode_bg1.jpg",
		"./Public/qpics/qrcode_bg2.jpg",
		"./Public/qpics/qrcode_bg3.jpg",
		"./Public/qpics/qrcode_bg4.jpg",
		"./Public/qpics/qrcode_bg5.jpg",
	),
	//paysapi参数
	'PAYSAPI'			=> array(
		"uid"=>"f9e7e35f5be9d25cf8dca06e",
		"token"=>"3e9cbb7d4de68b11c9e9d5af83699b4a",
	),
	
	//促销活动
	'PROMOTION'			=> array(
		1 => array(
			"title" => "首充活动提醒",
			"desc" => "开启后系统将在24小时之后对新关注未充值用户自动发送一次首充活动提醒消息",
			"img" => "./Public/admin/images/001.png",
		),
		2 => array(
			"title" => "未支付提醒",
			"desc" => "开启后系统将自动向符合条件的用户推送未支付提醒消息；推送时间：在未支付订单生成的半小时后自动发送一次推送提醒。",
			"img" => "./Public/admin/images/002.png",
		),
		3 => array(
			"title" => "继续阅读提醒",
			"desc" => "开启后系统将两小时未阅读的用户，自动推送一次继续阅读提醒消息。",
			"img" => "./Public/admin/images/003.png",
		),
		4 => array(
			"title" => "猜你喜欢推送",
			"desc" => "开启后系统将自动向符合条件的用户推送相应的客服消息。推送时间：在您确认托管开启之后24小时之内，将消息自动推送给相应的用户",
			"img" => "./Public/admin/images/005.png",
		),
	),
	
	
	'SESSION_OPTIONS'	=>  array(
        'name'                =>  'user',                    //设置session名
        'expire'              =>  5*3600,                   //SESSION保存24小时
        'use_trans_sid'       =>  1,                         //跨页传递
        'use_only_cookies'    =>  0,                         //是否只开启基于cookies的session的会话方式
    ),
);