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
<link rel="stylesheet" href="/Public/home/css/template3/nav.css">
   <link rel="stylesheet" type="text/css" href="/Public/home/css/footer4.css">
<div class="rt-bar">
	<div class="row">
		<div class="col icon">
			<a href="javascript:history.go(-1);">
			<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 40 40"><path d="M29.56 39.47a2 2 0 0 1-1.38-.56L8.45 20 28.17 1.09A2 2 0 1 1 30.94 4L14.23 20l16.71 16a2 2 0 0 1-1.38 3.44z" fill="#ff730a"></path></svg>
			</a>
		</div>
		<div class="col title" style="margin-right: 1.333rem;">
			书币明细
		</div>
	</div>
</div>
<div class="rt-tabs mt-10 tab">
	<div class="item">
		<a class="active" data-type="1">充值</a>
	</div>
	<div class="item">
		<a data-type="2">签到</a>
	</div>
	<div class="item">
		<a data-type="3">分享</a>
	</div>
</div>
<div class="rt-list" id="html_box">
	
</div>

<script>
    var page = 1;
    var wait = true;
	var type;
    $(function () {
		getData();
		
		$(document).bind("scroll", function (event) {
			if(!wait) return;
			var top = document.documentElement.scrollTop + document.body.scrollTop;
			var textheight = $(document).height();
			if (textheight - top - $(window).height() <= 50) {
				page++;
				getData();
			}
		});
		
        $(".tab a").click(function () {
			wait = true;
			page = 1;
            type =parseInt($(this).attr("data-type"));
			$(this).parents('.tab').find('a').removeClass('active');
			$(this).addClass('active');            
			$('#html_box').html("");
			getData();   
        });
		
	});
    function getData(){
		$.post("<?php echo U('Ajax/getReport');?>",{type:type,page:page},function(d){
			if(d){
				//console.log(d);
				if(d.status){
					$('#html_box').append(d.info);
				}else{
					if(page == 1 && $('#nolist').length == 0){
						$('#html_box').append('<li id="nolist" style="text-align:center;line-height: 3rem;list-style: none;font-size: .35rem;" class="mui-table-view-cell mui-media">抱歉，没有您的数据！</li>');
					}
					wait = false;
				}
			}else{
				bh_msg_tips('请求失败！');
			}
		});
    }
</script>

<div class="footer" id="footer_nav">
    <ul>
        <li><a href="<?php echo U('Index/readHistory');?>"><i class="icon-book"></i>书架</a></li>
        <li><a href="<?php echo U('Index/index');?>" class="active"><i class="icon-choice"></i>精选</a></li>
        <li><a href="<?php echo U('Index/my');?>"><i class="icon-my"></i>我的</a></li>
    </ul>
</div>