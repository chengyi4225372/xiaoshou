<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html data-dpr="1" style="font-size: 37.5px;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title><?php echo ($title); ?></title>
<link href="/Public/home/css/swiper.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/Public/home/css/style.min.css?time=<?php echo time();?>">
<link rel="stylesheet" type="text/css" href="/Public/home/css/font.css">
<link rel="stylesheet" type="text/css" href="/Public/layer/mobile/need/layer.css">
<script src="/Public/home/js/jquery-1.7.min.js"></script>
<script src="/Public/home/js/swiper.min.js"></script>
<script src="/Public/home/js/mui.min.js"></script>
<script src="/Public/layer/mobile/layer.js"></script>
<script src="/Public/home/js/jquery.cookie.js"></script>
</head>
<body style="font-size: 12px;" class="mui-ios mui-ios-11 mui-ios-11-0">
	<link rel="stylesheet" type="text/css" href="/Public/home/css/footer4.css">
<div style="font-size: .4rem;background: #ff730b;color: #fff;padding: .4rem;" id="msg">
	<p>海报推广赚书币步骤</p>
	<p>1、点击下面海报图片保存到相册</p>
	<p>2、把保存好的海报图片发送到朋友圈</p>
	<p>3、把保存好的海报图片群发给好友</p>
</div>
<div class="qrcode-main" style="z-index:9999">
	<img src="<?php echo ($img); ?>" id="qrcode" style=" width:100%" />
</div>
<script>
	$(document).ready(function(d){
		var h = $(window).height();
			footer = $('#myfooter').height();
			msg = $('#msg').height();
			img_h = h - msg - footer - 30;
		$("#qrcode").height(img_h+"px");
	});
</script>
<div style="height:50px;"></div>

<div class="footer" id="footer_nav">
    <ul>
        <li><a href="<?php echo U('Index/readHistory');?>"><i class="icon-book"></i>书架</a></li>
        <li><a href="<?php echo U('Index/index');?>" class="active"><i class="icon-choice"></i>精选</a></li>
        <li><a href="<?php echo U('Index/my');?>"><i class="icon-my"></i>我的</a></li>
    </ul>
</div>