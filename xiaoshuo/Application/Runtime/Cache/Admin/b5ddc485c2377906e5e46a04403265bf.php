<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="height: auto;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ($_site['name']); ?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="/Public/admin/css/bootstrap.min.css">
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/admin/css/ionicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/admin/css/AdminLTE.min.css">
<link rel="stylesheet" href="/Public/admin/css/_all-skins.min.css">
<link rel="stylesheet" href="/Public/admin/css/blue.css">
<link rel="stylesheet" href="/Public/admin/css/bootstrap-datetimepicker.min.css">
<link href="https://novel.youshuge.com/img/favicon.ico" rel="icon" type="image/x-icon">
<link rel="stylesheet" href="/Public/layer/skin/default/layer.css">
<script src="/Public/admin/js/jquery-2.2.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/admin/js/bootstrap-datetimepicker.min.js"></script>
<script src="/Public/admin/js/app.min.js"></script>
<script src="/Public/layer/layer.js"></script>
<style type="text/css">
	.skin-purple-light .wrapper, .skin-purple-light .main-sidebar, .skin-purple-light .left-side {
		background-color: #f9f9f9;
	}

	.skin-purple-light .sidebar-menu > li > .treeview-menu {
		background-color: #e8e8e8;
	}

	.skin-purple-light .sidebar-menu > li > a {
		font-weight: unset;
	}

	.skin-purple-light .treeview-menu > li.active > a, .skin-purple-light .sidebar-menu > li.active > a, .skin-purple-light .treeview-menu > li.active > a {
		background-color: #e6f7ff;
		border-right: 2px solid #168fff;
		color: #57b6ff;
		font-weight: unset;
	}

	.skin-purple-light .sidebar-menu > li:hover > a, .skin-purple-light .sidebar-menu > li:hover > a, .skin-purple-light .treeview-menu > li > a:hover, .skin-purple-light .sidebar-menu > li > a:hover {
		color: #57b6ff;
	}

	.sidebar-menu .treeview-menu > li > a {
		padding-left: 40px;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.sidebar-menu .treeview-menu {
		padding-left: 0;
	}

	.skin-purple-light .sidebar a {
		color: #666;
	}

	.wysiwyg-color-black {
		color: black !important;
	}

	.wysiwyg-color-silver {
		color: silver !important;
	}

	.wysiwyg-color-gray {
		color: gray !important;
	}

	.wysiwyg-color-maroon {
		color: maroon !important;
	}

	.wysiwyg-color-red {
		color: red !important;
	}

	.wysiwyg-color-purple {
		color: purple !important;
	}

	.wysiwyg-color-green {
		color: green !important;
	}

	.wysiwyg-color-olive {
		color: olive !important;
	}

	.wysiwyg-color-navy {
		color: navy !important;
	}

	.wysiwyg-color-blue {
		color: blue !important;
	}

	.wysiwyg-color-orange {
		color: orange !important;
	}
	.glyphicon {
		margin-right: 6px;
	}
	.wechat{
		line-height: 50px;
		width: 100%;
		display: block;
		text-align: center;
		font-size: 24px;
		color: #ecfd02;
	}
</style>
<link rel="stylesheet" href="/Public/admin/css/laydate.css" id="layuicss-laydate">
<style type="text/css">
	.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
</style>
</head>
<body class="sidebar-mini skin-purple-light" style="height: auto;">
<div class="wrapper" style="height: auto;">
    <header class="main-header">
        <a href="<?php echo U('Index/index');?>" class="logo">
            <span class="logo-mini"><b><?php echo substr($_site['name'],0,3);?></b><?php echo substr($_site['name'],3,3);?></span>
            <span class="logo-lg">
				<img src="/Public/admin/images/logo.png">
				<b><?php echo ($_site['name']); ?></b>
			</span>
			
        </a>
        <nav class="navbar navbar-static-top">
            <a href="<?php echo U('Index/index');?>" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="<?php echo U('Index/index');?>" class="user-panel dropdown-toggle" data-toggle="dropdown" style="height: 50px; display: flex;">
                            <img src="/Public/admin/images/avatar2.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo session('admin.name');?></span>
                            <span>
                               <i class="fa fa-angle-down"></i>
                               <i class="fa fa-angle-up hidden"></i>
                           </span>
                        </a>
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close" style="width: 150px;">
                            <li>
                                <a href="<?php echo U('Config/site');?>"><i class="fa fa-fw fa-user"></i> 站点设置</a>
                            </li>
                            <li>
                                <a href="<?php echo U('Config/user');?>"><i class="fa fa-fw fa-key"></i> 修改密码</a>
                            </li>
                            <li class="divider"></li>
							<li>
                                <a href="<?php echo U('Config/camera');?>"><i class="fa fa-fw fa-camera"></i> 视频教程</a>
                            </li>
							<li class="divider"></li>
                            <li>
                                <a href="<?php echo U('Pub/logout');?>">
                                    <i class="fa fa-fw fa-power-off"></i> 安全退出
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
   
    <aside class="main-sidebar">
        <section class="sidebar" style="height: auto;">
            <ul class="sidebar-menu">
				<li>
                    <a href="<?php echo U('Index/index');?>">
                        <i class="fa fa-tasks"></i> <span>首页</span>
                    </a>
                </li>
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-sun-o"></i> 
						<span>站点设置</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Config/site');?>">
								<i class="fa fa-angle-right"></i> 
								站点设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/charge');?>">
								<i class="fa fa-angle-right"></i>
								充值设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/navindex');?>">
								<i class="fa fa-angle-right"></i>
								底部导航
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/middleindex');?>">
								<i class="fa fa-angle-right"></i>
								中间导航
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/ads');?>">
								<i class="fa fa-angle-right"></i> 
								广告设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/tpl');?>">
								<i class="fa fa-angle-right"></i> 
								模版设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/logo');?>">
								<i class="fa fa-angle-right"></i>
								首页logo
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/user');?>">
								<i class="fa fa-angle-right"></i> 
								修改密码
							</a>
						</li>
                    </ul>
				</li>
                
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-bar-chart"></i> 
						<span>数据统计</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Center/orders');?>">
								<i class="fa fa-angle-right"></i> 
								订单统计
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Center/users');?>">
								<i class="fa fa-angle-right"></i> 
								用户统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/charge');?>">
								<i class="fa fa-angle-right"></i> 
								充值统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/separate');?>">
								<i class="fa fa-angle-right"></i> 
								分成统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/chapter');?>">
								<i class="fa fa-angle-right"></i> 
								外推统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/lodge');?>">
								<i class="fa fa-angle-right"></i> 
								举报统计
							</a>
						</li>
                    </ul>
				</li>
								
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-bar-chart"></i> 
						<span>财务统计</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Center/corder');?>">
								<i class="fa fa-angle-right"></i> 
								订单信息
							</a>
						</li>
						<li>
							<a href="<?php echo U('Charge/index');?>">
								<i class="fa fa-angle-right"></i> 
								充值记录
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/withdraw');?>">
								<i class="fa fa-angle-right"></i> 
								代理结算
							</a>
						</li>
                    </ul>
				</li> 
                <!-- <li class="treeview">
                    <a href="#">
						<i class=" fa fa-image"></i> 
						<span>漫画管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Config/mhArea');?>">
								<i class="fa fa-angle-right"></i> 
								发布区域
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Config/mhStore');?>">
								<i class="fa fa-angle-right"></i> 
								漫画分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/mhBanner');?>">
								<i class="fa fa-angle-right"></i> 
								漫画轮播
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/caric');?>">
								<i class="fa fa-angle-right"></i> 
								漫画列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/caricRecover');?>">
								<i class="fa fa-angle-right"></i> 
								漫画仓库
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/caricComments');?>">
								<i class="fa fa-angle-right"></i> 
								评论管理
							</a>
						</li>
                    </ul>
				</li>
				 -->
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-book"></i> 
						<span>小说管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Config/xsArea');?>">
								<i class="fa fa-angle-right"></i> 
								发布区域
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Config/xsStore');?>">
								<i class="fa fa-angle-right"></i> 
								小说分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/xsBanner');?>">
								<i class="fa fa-angle-right"></i> 
								小说轮播
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/novel');?>">
								<i class="fa fa-angle-right"></i> 
								小说列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/novelRecover');?>">
								<i class="fa fa-angle-right"></i> 
								小说仓库
							</a>
							<li>
							<a href="<?php echo U('Book/novelComments');?>">
								<i class="fa fa-angle-right"></i> 
								评论管理
							</a>
						</li>
						</li>
                    </ul>
				</li>
				
				<!-- <li class="treeview">
                    <a href="#">
						<i class=" fa fa-podcast"></i> 
						<span>听书管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Config/stArea');?>">
								<i class="fa fa-angle-right"></i> 
								发布区域
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Config/stStore');?>">
								<i class="fa fa-angle-right"></i> 
								听书分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/stBanner');?>">
								<i class="fa fa-angle-right"></i> 
								听书轮播
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/story');?>">
								<i class="fa fa-angle-right"></i> 
								听书列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/storyRecover');?>">
								<i class="fa fa-angle-right"></i> 
								听书仓库
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/storyComments');?>">
								<i class="fa fa-angle-right"></i> 
								评论管理
							</a>
						</li>
                    </ul>
				</li>
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-file-video-o"></i> 
						<span>视频/电影管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Config/vdBanner');?>">
								<i class="fa fa-angle-right"></i> 
								轮播图设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/vdStore');?>">
								<i class="fa fa-angle-right"></i> 
								影视分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/vdArea');?>">
								<i class="fa fa-angle-right"></i> 
								<span>发布区域</span>
							</a>
						</li>
						<li>
							<a href="<?php echo U('Video/index');?>">
								<i class="fa fa-angle-right"></i> 
								<span>影视列表</span>
							</a>
						</li>
                    </ul>
				</li>
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-file-image-o"></i> 
						<span>漫画文案</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Cartoon/index');?>">
								<i class="fa fa-angle-right"></i> 
								漫画列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Chapter/index');?>">
								<i class="fa fa-angle-right"></i> 
								推广链接
							</a>
						</li>
						<li>
							<a href="<?php echo U('Chapter/delList');?>">
								<i class="fa fa-angle-right"></i> 
								推广回收
							</a>
						</li>
                    </ul>
				</li> -->
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-book"></i> 
						<span>小说文案</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Novel/index');?>">
								<i class="fa fa-angle-right"></i> 
								小说列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Nhapter/index');?>">
								<i class="fa fa-angle-right"></i> 
								推广链接
							</a>
						</li>
						<li>
							<a href="<?php echo U('Nhapter/delList');?>">
								<i class="fa fa-angle-right"></i> 
								推广回收
							</a>
						</li>
                    </ul>
				</li>
				<li>
                    <a href="<?php echo U('User/index');?>">
                        <i class="fa fa-users"></i><span>粉丝信息</span>
                    </a>
                </li>
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-user-plus"></i> 
						<span>渠道/代理商</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Mch/indes');?>">
								<i class="fa fa-angle-right"></i> 
								代理商管理
							</a>
						</li>
						<li>
							<a href="<?php echo U('Mch/index');?>">
								<i class="fa fa-angle-right"></i> 
								渠道商管理
							</a>
						</li>
                    </ul>
				</li>
				
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-commenting"></i> 
						<span>消息推送</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Custom/index');?>">
								<i class="fa fa-angle-right"></i> 
								群发推送
							</a>
						</li>
						<li>
							<a href="<?php echo U('Autoreply/index');?>">
								<i class="fa fa-angle-right"></i> 
								关键词回复
							</a>
						</li>
						<li>
							<a href="<?php echo U('Activity/index');?>">
								<i class="fa fa-angle-right"></i> 
								促销活动
							</a>
						</li>
                    </ul>
				</li>
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-gears"></i> 
						<span>公众号设置</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Selfmenu/index');?>">
								<i class="fa fa-angle-right"></i> 
								公众号菜单
							</a>
						</li>
						<li>
							<a href="<?php echo U('Index/integrate');?>">
								<i class="fa fa-angle-right"></i> 
								公众号配置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Selfmenu/links');?>">
								<i class="fa fa-angle-right"></i> <span>获取链接菜单</span>
							</a>
						</li>
                    </ul>
				</li>
				
				
				<li>
                    <a href="<?php echo U('Article/index');?>">
                        <i class="fa fa-newspaper-o"></i> <span>文案信息</span>
                    </a>
                </li>
				

				<!-- <li class="treeview">
                    <a href="#">
						<i class=" fa fa-diamond"></i> 
						<span>购物商城</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Seller/index');?>">
								<i class="fa fa-angle-right"></i> 
								商品管理
							</a>
						</li>
						<li>
							<a href="<?php echo U('Seller/record');?>">
								<i class="fa fa-angle-right"></i> 
								购买记录
							</a>
						</li>
                    </ul>
				</li> -->
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-bullhorn"></i> 
						<span>公告管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Notice/index');?>">
								<i class="fa fa-angle-right"></i> 
								代理公告
							</a>
						</li>
						<li>
							<a href="<?php echo U('Umsg/index');?>">
								<i class="fa fa-angle-right"></i> 
								个人公告
							</a>
						</li>
                    </ul>
				</li>
				<li>
                    <a href="<?php echo U('Feed/index');?>">
                        <i class="fa fa-comment"></i> <span>用户反馈</span>
                    </a>
                </li>
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-cny"></i> 
						<span>打赏信息</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Config/prize');?>">
								<i class="fa fa-angle-right"></i> 
								打赏金额设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Prize/index');?>">
								<i class="fa fa-angle-right"></i> 
								打赏列表
							</a>
						</li>
                    </ul>
				</li>
				<li>
                    <a href="<?php echo U('Joinus/index');?>">
                        <i class="fa fa-address-card"></i><span>加盟代理记录</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper" style="min-height: 848px;">
       <section class="content-header">
<div>
	<ol class="breadcrumb" style="background: none; margin-bottom: 0px;">
		<li><a href="<?php echo U('Index/index');?>" style="color: #333;"><i class=" fa fa-home"></i> Home</a></li>
		<li class="active">数据统计</li>
		<li class="active"> 订单统计</li>
	</ol>
</div>

</section>

<section class="content">
	<div class="row" id="order-summary-stats-panel">
		<div class="col-md-4">
			<div class="well">
				<b>
					今日充值 <i class="fa fa-question-circle" title="不含当日，统计实时数据"></i>
				</b>
				<div class="text-primary" style="font-size:32px;margin:5px 0">
					¥<span><?php echo ((isset($tcharge['total']) && ($tcharge['total'] !== ""))?($tcharge['total']):"0.00"); ?></span>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4" style="padding:0">
							<strong>普通充值</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($tcharge['ptotal']) && ($tcharge['ptotal'] !== ""))?($tcharge['ptotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($tcharge['pnums']); ?></b> 笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($tcharge['pwnums']); ?></b>笔</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $tcharge['pnums']+$tcharge['pwnums']; $lv = sprintf("%.2f",$tcharge['pnums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>年费VIP会员</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($tcharge['ytotal']) && ($tcharge['ytotal'] !== ""))?($tcharge['ytotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($tcharge['ynums']); ?></b> 笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($tcharge['ywnums']); ?></b>笔</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $tcharge['ynums']+$tcharge['ywnums']; $lv = sprintf("%.2f",$tcharge['ynums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>终生VIP会员</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($tcharge['ztotal']) && ($tcharge['ztotal'] !== ""))?($tcharge['ztotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($tcharge['znums']); ?></b> 笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($tcharge['zwnums']); ?></b>笔</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $tcharge['znums']+$tcharge['zwnums']; $lv = sprintf("%.2f",$tcharge['znums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well">
				<b>昨日充值	<i class="fa fa-question-circle" title="不含当日，统计实时数据"></i></b>
				<div class="text-primary" style="font-size:32px;margin:5px 0">
					¥<span><?php echo ($yescharge['charge_total']); ?></span>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4" style="padding:0">
							<strong>普通充值</strong>
							<div>
								<b class="text-warning"><?php echo ($yescharge['pcharge']); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($yescharge['pchargenums']); ?></b> 笔
							</div>
							<div>未支付: <b class="text-warning"><?php echo ($yescharge['pchargewnums']); ?></b>
								笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $yescharge['pchargenums']+$yescharge['pchargewnums']; $lv = sprintf("%.2f",$yescharge['pchargenums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>年费VIP会员</strong>
							<div>
								<b class="text-warning"><?php echo ($yescharge['ycharge']); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($yescharge['ychargenums']); ?></b> 笔
							</div>
							<div>未支付: <b class="text-warning"><?php echo ($yescharge['ychargewnums']); ?></b>
								笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $yescharge['ychargenums']+$yescharge['ychargewnums']; $lv = sprintf("%.2f",$yescharge['ychargenums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>终生VIP会员</strong>
							<div>
								<b class="text-warning"><?php echo ($yescharge['zcharge']); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($yescharge['zchargenums']); ?></b> 笔
							</div>
							<div>未支付: <b class="text-warning"><?php echo ($yescharge['zchargewnums']); ?></b>
								笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $yescharge['zchargenums']+$yescharge['zchargewnums']; $lv = sprintf("%.2f",$yescharge['zchargenums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<b>累计充值 (含当日) <i class="fa fa-question-circle" title="含当日，统计实时数据"></i> </b>
				<div class="text-primary" style="font-size:32px;margin:5px 0">
					¥<span><?php echo ((isset($acharge['total']) && ($acharge['total'] !== ""))?($acharge['total']):"0.00"); ?></span>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4" style="padding:0">
							<strong>普通充值</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($acharge['ptotal']) && ($acharge['ptotal'] !== ""))?($acharge['ptotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($acharge['pnums']); ?></b>笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($acharge['pwnums']); ?></b>笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $acharge['pnums']+$acharge['pwnums']; $lv = sprintf("%.2f",$acharge['pnums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>年费VIP会员</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($acharge['ytotal']) && ($acharge['ytotal'] !== ""))?($acharge['ytotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($acharge['ynums']); ?></b>笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($acharge['ywnums']); ?></b>笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $acharge['ynums']+$acharge['ywnums']; $lv = sprintf("%.2f",$acharge['ynums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>终生VIP会员</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($acharge['ztotal']) && ($acharge['ztotal'] !== ""))?($acharge['ztotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($acharge['znums']); ?></b>笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($acharge['zwnums']); ?></b>笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $acharge['znums']+$acharge['zwnums']; $lv = sprintf("%.2f",$acharge['znums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default" id="order-daily-stats-panel">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-calendar"></i> 历史充值统计</h3>
		</div>
		<div class="loading-panel" style="display: none;">
			<i class="fa fa-spinner fa-spin"></i>
		</div>
		<table class="table table-bordered table-striped table-hover">
			<thead>
			<tr>
				<th colspan="6">
					<form class="form-inline" method="post">
						<div class="input-group input-group-sm">
						<input type="text" name="time1" class="form-control reservationtime" placeholder="开始时间" value="<?php echo ($_GET['time1']); ?>">
						</div>
						<span>-</span>
						<div class="input-group input-group-sm">
						<input type="text" name="time2" class="form-control reservationtime" placeholder="结束时间" value="<?php echo ($_GET['time1']); ?>">
						</div>
						<div class="input-group input-group-sm">
							<input type="submit" value="导出数据" class="btn btn-sm btn-success">
						</div>
					</form>
				</th>
			</tr>
			<tr>
				<th>日期</th>
				<th class="text-right">充值金额</th>
				<th class="text-right">普通充值</th>
				<th class="text-right">普通充值支付订单数</th>
				<th class="text-right">年费VIP会员</th>
				<th class="text-right">年费VIP会员支付订单数</th>
				<th class="text-right">终生VIP会员</th>
				<th class="text-right">终生VIP会员支付订单数</th>
			</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
					<td><span><?php echo ($v["date"]); ?></span></td>
					<td class="text-right">
						<b>¥ <span><?php echo ($v["charge_total"]); ?></span></b>
					</td>
					
					<td class="text-right">
						¥ <span><?php echo ($v["pcharge"]); ?></span>
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							充值人数: <span><?php echo ($v["pchargeperson"]); ?></span>,
							人均: ¥ <span>
							<?php echo ($v['pcharge']/$v['pchargeperson']); ?>
							</span>
						</div>
					</td>
					<td class="text-right">
						<span><?php echo ($v["pchargenums"]); ?></span> 笔
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							<span><?php echo ($v["pchargewnums"]); ?></span> 笔未支付,
							完成率: <span>
							<?php  $all = $v['pchargenums'] + $v['pchargewnums']; $lv = sprintf("%.2f",$v['pchargenums']/$all)*100; echo $lv; ?>
							</span> %
						</div>
					</td>
					
					<td class="text-right">
						¥ <span><?php echo ($v["ycharge"]); ?></span>
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							充值人数: <span><?php echo ($v["ychargeperson"]); ?></span>,
							人均: ¥ <span>
							<?php echo ($v['ycharge']/$v['ychargeperson']); ?>
							</span>
						</div>
					</td>
					<td class="text-right">
						<span><?php echo ($v["ychargenums"]); ?></span> 笔
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							<span><?php echo ($v["ychargewnums"]); ?></span> 笔未支付,
							完成率: <span>
							<?php  $all = $v['ychargenums'] + $v['ychargewnums']; $lv = sprintf("%.2f",$v['ychargenums']/$all)*100; echo $lv; ?>
							</span> %
						</div>
					</td>
					
					<td class="text-right">
						¥ <span><?php echo ($v["zcharge"]); ?></span>
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							充值人数: <span><?php echo ($v["zchargeperson"]); ?></span>,
							人均: ¥ <span>
							<?php echo ($v['zcharge']/$v['zchargeperson']); ?>
							</span>
						</div>
					</td>
					<td class="text-right">
						<span><?php echo ($v["zchargenums"]); ?></span> 笔
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							<span><?php echo ($v["zchargewnums"]); ?></span> 笔未支付,
							完成率: <span>
							<?php  $all = $v['zchargenums'] + $v['zchargewnums']; $lv = sprintf("%.2f",$v['zchargenums']/$all)*100; echo $lv; ?>
							</span> %
						</div>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</section>


<script>
        $.fn.datetimepicker.dates['zh-CN'] = {
            days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
            daysShort: ["日", "一", "二", "三", "四", "五", "六", "日"],
            daysMin: ["日", "一", "二", "三", "四", "五", "六", "日"],
            months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            monthsShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],
            meridiem: ["上午", "下午"],
            today: "今天"
        };

        $('.reservationtime').datetimepicker({
            format: 'yyyy-mm-dd',
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            showMeridian: 1
        });
</script>

    </div>
  
    <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<script src="/Public/admin/js/common.js"></script>
<script>
	var route = "<?php echo ($CAname); ?>";
    var href = '';
    $('.sidebar-menu').find('a').each(function () {
        $(this).parent('li').removeClass('active');
        href = $(this).attr('href');
        if ((href.indexOf(route) != -1) && (route != '/')) {
            $(this).parent('li').addClass('active');
            $(this).parents('.treeview').addClass('active');
		}
    });

    $('.dropdown-toggle').click(function (ev) {
        $(this).find('.fa-angle-down').toggleClass('hidden');
        $(this).find('.fa-angle-up').toggleClass('hidden');
    });
	
	// 调整默认选择内容
	$("select").each(function(index, element) {
		$(element).find("option[value='"+$(this).attr('default')+"']").attr('selected','selected');
	});
</script>
</body>
</html>