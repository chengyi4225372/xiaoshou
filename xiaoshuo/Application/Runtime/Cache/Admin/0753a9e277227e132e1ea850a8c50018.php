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
			<li>
				<a href="<?php echo U('Index/index');?>" style="color: #333;">
					<i class=" fa fa-home"></i>&nbsp;Home
				</a>
			</li>
			<li class="active">添加渠道商</li>
			<li class="active"><?php if($_GET['id']): ?>修改代理信息<?php else: ?>编辑渠道商信息<?php endif; ?></li>
		</ol>
	</div>

</section>
	<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<form id="main-form" class="form-horizontal" style="margin-top:30px" method="post">
					<div class="form-group">
						<label class="control-label col-sm-3">站点名称</label>
						<div class="col-sm-6">
							<input type="text" name="title" class="form-control col-sm-9" value="<?php echo ($info["title"]); ?>" required="">
							<p class="help-block help-block-error col-sm-12 col-xs-10" style="color:red;padding-left:0"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">用户名</label>
						<div class="col-sm-6">
							<input type="text" name="username" class="form-control col-sm-9" value="<?php echo ($info["username"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">登录密码</label>
						<div class="col-sm-6">
							<input type="text" name="pass" class="form-control col-sm-9" value="<?php echo ($info["tpass"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">代理名称</label>
						<div class="col-sm-6">
							<input type="text" name="name" class="form-control col-sm-9" value="<?php echo ($info["name"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">手机号</label>
						<div class="col-sm-6">
							<input type="text" name="mobile" class="form-control col-sm-9" value="<?php echo ($info["mobile"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">渠道QQ</label>
						<div class="col-sm-6">
							<input type="text" name="qq" class="form-control col-sm-9" value="<?php echo ($info["qq"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">渠道微信</label>
						<div class="col-sm-6">
							<input type="text" name="weixin" class="form-control col-sm-9" value="<?php echo ($info["weixin"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">渠道防封域名</label>
						<div class="col-sm-6">
							<input type="text" name="url" class="form-control col-sm-9" value="<?php echo ($info["url"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">支付方式</label>
						<div class="col-sm-6">
							<select class="form-control col-sm-9" name="paymodel" default="<?php echo ($info['paymodel']); ?>">
								<option value="">请选择</option>
								<option value="1">微信支付</option>
								<option value="2">PAYSAPI支付</option>
								<option value="3">支付宝支付</option>
							</select>
							<p class="help-block help-block-error col-sm-7 col-xs-10"><?php echo ($_site['paymsg']); ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">App ID</label>
						<div class="col-sm-6">
							<input type="text" name="appid" class="form-control col-sm-9" value="<?php echo ($info["appid"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">App Secret</label>
						<div class="col-sm-6">
							<input type="text" name="appsecret" class="form-control col-sm-9" value="<?php echo ($info["appsecret"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3">白名单地址</label>
						<div class="col-sm-6">
							<input type="text" name="ips" class="form-control col-sm-9" value="<?php echo ($info["ips"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10">多个IP请以英文字符“|”隔开</p>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3">返额比例</label>
						<div class="col-sm-6">
							<input type="text" name="lv" class="form-control col-sm-9" value="<?php echo ($info["lv"]); ?>" required="">
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;">单位：%，填写 0 到 100 之间的数字，设置比例不能超过100%</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">距扣量数</label>
						<div class="col-sm-6">
							<input type="text" name="onums" class="form-control col-sm-9" value="<?php echo ($info["onums"]); ?>" style="width:50%;float:left" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;">订单数量达到设定的距扣量数笔进行扣量</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">扣量比例</label>
						<div class="col-sm-6">
							<input type="text" class="form-control col-sm-3" value="1" style="background:#ddd;width:40%;float:left" readonly />
							<span style="float:left;margin:1% 20px">比</span>
							<input type="text" name="desc" class="form-control col-sm-3" value="<?php echo ($info["desc"]); ?>" style="width:40%;float:left" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;">每多少笔订单扣除一笔订单</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">收款方式</label>
						<div class="col-sm-6">
							<select class="form-control col-sm-9" id="balance" name="balancemodel" default="<?php echo ($info['balancemodel']); ?>" onchange="chooseBalance()">
								<option value="">请选择</option>
								<option value="1">银行卡收款</option>
								<option value="2">支付宝收款</option>
							</select>
							<p class="help-block help-block-error col-sm-7 col-xs-10"></p>
						</div>
					</div>
					
					<div class="form-group balance1" style="display:none;">
						<label class="control-label col-sm-3">结算收款人</label>
						<div class="col-sm-6">
							<input type="text" name="bankname" class="form-control col-sm-9" value="<?php echo ($info["bankname"]); ?>" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;"></p>
						</div>
					</div>
					<div class="form-group balance1" style="display:none;">
						<label class="control-label col-sm-3">结算银行</label>
						<div class="col-sm-6">
							<input type="text" name="bank" class="form-control col-sm-9" value="<?php echo ($info["bank"]); ?>" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;"></p>
						</div>
					</div>
					<div class="form-group balance1" style="display:none;">
						<label class="control-label col-sm-3">结算银行卡号</label>
						<div class="col-sm-6">
							<input type="text" name="bankno" class="form-control col-sm-9" value="<?php echo ($info["bankno"]); ?>" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;"></p>
						</div>
					</div>
					
					<div class="form-group balance2" style="display:none;">
						<label class="control-label col-sm-3">支付宝姓名</label>
						<div class="col-sm-6">
							<input type="text" name="zfbname" class="form-control col-sm-9" value="<?php echo ($info["zfbname"]); ?>" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;"></p>
						</div>
					</div>
					<div class="form-group balance2" style="display:none;">
						<label class="control-label col-sm-3">支付宝账号</label>
						<div class="col-sm-6">
							<input type="text" name="zfbno" class="form-control col-sm-9" value="<?php echo ($info["zfbno"]); ?>" />
							<p class="help-block help-block-error col-sm-7 col-xs-10" style="color:red;padding-left:0;"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">渠道公众号二维码</label>
						<div class="col-sm-6">
							<iframe src="<?php echo U('Index/upload', 'event=setPic&url='.$info['qrcode']);?>" scrolling="no" style="width:200px;height:200px;border: none;display:block"></iframe>
							<input type="hidden" name="qrcode" id="qrcode" value="<?php echo ($info['qrcode']); ?>" class="smallinput" />
							<script>
							function setPic(url){
								document.getElementById('qrcode').value = url;
							}
							</script>
							<p class="help-block help-block-error col-sm-7 col-xs-10">点击图片可进行更换</p>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<input type="hidden" name="type" value="1" />
								<button type="button" id="ajaxBtn" class="btn btn-primary">保存</button>
								<button type="button" class="btn btn-inverse" style="margin-left:20px;" onclick="history.go(-1)">返回</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(function(){
		var balance = $('#balance option:selected').val();
		if(balance == 1){
			$('.balance1').show();
		}else if(balance == 2){
			$('.balance2').show();
		}
	});
	
	function chooseBalance(){
		var val = $('#balance option:selected').val();
		if(val == 1){
			$('.balance1').show();
			$('.balance2').hide();
		}else if(val == 2){
			$('.balance2').show();
			$('.balance1').hide();
		}else{
			$('.balance1').hide();
			$('.balance2').hide();
		}
	}
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